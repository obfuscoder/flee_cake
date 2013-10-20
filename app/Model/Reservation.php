<?php

class Reservation extends AppModel {
	public $belongsTo = array(
		"Seller",
		"Event"
	);

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
			return $nextReservationNumber;
		}
		return false;
	}

}

?>