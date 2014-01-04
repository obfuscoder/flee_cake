<?php

class Seller extends AppModel {
	public $hasMany = array(
		"Item",
		"Reservation"
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
}

?>