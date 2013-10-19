<?php

class Reservation extends AppModel {
	public $belongsTo = array(
		"Seller",
		"Event"
	);

	public function getNextReservationNumber($eventId) {
		$result = $this->find("first", array(
			"conditions" => array("event_id" => $eventId),
			"fields" => array("max(Reservation.number) as max_reservation_number")
		));
		$max = $result[0]["max_reservation_number"];
		return ($max === null) ? 1 : $max+1;
	}
}

?>