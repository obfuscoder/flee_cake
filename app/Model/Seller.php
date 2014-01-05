<?php

class Seller extends AppModel {
	public $hasMany = array(
		"Item",
		"Reservation"
	);

	public $validate = array(
		"first_name" => array("rule" => "notEmpty", "message" => "Bitte geben Sie einen Vornamen ein."),
		"last_name" => array("rule" => "notEmpty", "message" => "Bitte geben Sie einen Nachnamen ein."),
		"street" => array("rule" => "notEmpty", "message" => "Bitte geben Sie eine Straße ein."),
		"zip_code" => array("rule" => array("postal", null, "de"), "message" => "Die Postleitzahl darf nur aus 5 Ziffern bestehen."),
		"city" => array("rule" => "notEmpty", "message" => "Bitte geben Sie einen Ort ein."),
		"phone" => array("rule" => array("phone", '/[0-9\/. \-]*/', "de"), "message" => "Bitte geben Sie eine gültige Telefonnummer ein."),
		"email" => array(
			"email" => array("rule" => "email", "message" => "Geben Sie bitte eine gültige eMail-Adresse an."),
			"unique" => array("rule" => "isUnique", "message" => "Es existiert bereits eine Registrierung für diese eMail-Adresse")
		)
	);

	public function findAllUnreserved($eventId) {
		return $this->find('all', array(
			"recursive" => 0,
    		"conditions" => array(
    			"Seller.active" => true,
    			"Seller.id not in (select seller_id from reservations where reservations.event_id = $eventId)"
			)
     	));
	}

	public function sendInvitation($seller, $event) {
		App::uses('CakeEmail', 'Network/Email');
		$mail = new CakeEmail('default');
		$mail->template("invite", "default")
			->emailFormat("text")
			->to($seller["Seller"]["email"])
			->subject("Reservierung zum Flohmarkt startet in Kürze")
			->viewVars(compact("seller", "event"))
			->send();
	}

	public function sendInvitationsToUnreserved($event) {
		$id = $event["Event"]["id"];
		$unreservedSellers = $this->findAllUnreserved($id);
		foreach($unreservedSellers as $seller) {
			$this->sendInvitation($seller, $event);
		}
		return count($unreservedSellers);
	}

	public function sendNotifications($event) {
		$sellers = $this->findAllUnreservedWithNotify($event["Event"]["id"]);
		foreach($sellers as $seller) {
			$this->sendNotification($seller, $event);
		}
		return count($sellers);
	}

	private function findAllUnreservedWithNotify($eventId) {
		return $this->find('all', array(
			"recursive" => 0,
    		"conditions" => array(
    			"Seller.active" => true,
    			"Seller.notify" => true,
    			"Seller.id not in (select seller_id from reservations where reservations.event_id = $eventId)"
			)
     	));
	}

	private function sendNotification($seller, $event) {
		App::uses('CakeEmail', 'Network/Email');
		$mail = new CakeEmail('default');
		$mail->template("notification", "default")
			->emailFormat("text")
			->to($seller["Seller"]["email"])
			->subject("Verkäuferplatz beim Flohmarkt freigeworden")
			->viewVars(compact("seller", "event"))
			->send();
	}

	public function notify($id) {
		$this->set_notify($id, 1);
	}

	public function unnotify($id) {
		$this->set_notify($id, 0);
	}

	private function set_notify($id, $notify) {
		$this->id = $id;
		$this->saveField("notify", $notify);
	}
}

?>