<?php

class Reservation extends AppModel {
	public $belongsTo = array(
		"Seller",
		"Event"
	);
	public $hasAndBelongsToMany = array("Item" => array("with" => "ReservedItem", "unique" => "keepExisting", "order" => "ReservedItem.number"));

	private function getNextReservationNumber($eventId) {
		$result = $this->find("first", array(
			"conditions" => array("event_id" => $eventId),
			"fields" => array("max(Reservation.number) as max_reservation_number")
		));
		$max = $result[0]["max_reservation_number"];
		return ($max === null) ? 1 : $max+1;
	}

	public function add($reservation) {
		$nextReservationNumber = $this->getNextReservationNumber($reservation["event_id"]);
		$this->create();
		$reservation["number"] = $nextReservationNumber;
		if ($this->save($reservation)) {
			$this->sendConfirmation();
			return $nextReservationNumber;
		}
		return false;
	}

	private function sendConfirmation() {
		$reservation = $this->findById($this->id);
		App::uses('CakeEmail', 'Network/Email');
		$mail = new CakeEmail('queue');
		$mail->template("reservation", "default")
			->emailFormat("text")
			->to($reservation["Seller"]["email"])
			->subject("Flohmarkt Reservierung erfolgt")
			->viewVars(compact("reservation"))
			->send();
	}

	public function count($eventId) {
		return $this->find("count", array('conditions' => array('Reservation.event_id' => $eventId)));
	}
}

?>