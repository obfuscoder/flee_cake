<?php

class Item extends AppModel {
	public $belongsTo = array("Seller", "Category");
	public $hasAndBelongsToMany = array("Reservation" => array("with" => "ReservedItem", "unique" => "keepExisting", "order" => "ReservedItem.number"));

	public $validate = array(
		"description" => array("rule" => array("between", "4", "20"), "message" => "Bitte geben Sie eine sinnvolle Beschreibung mit 4 bis 30 Buchstaben ein."),
		"price" => array("rule" => "notEmpty", "message" => "Bitte geben Sie einen Preis ein.")
	);

	public function getNextReservedItemNumber($reservationId) {
		$result = $this->ReservedItem->find("first", array(
			"conditions" => array("reservation_id" => $reservationId),
			"fields" => array("max(ReservedItem.number) as max_number")
		));
		$max = $result[0]["max_number"];
		return ($max === null) ? 1 : $max+1;
	}

	// http://en.wikipedia.org/wiki/Luhn_algorithm
	public function getChecksum($number) {
		$digits = strrev($number);
		$checksum = 0;
		for ($i=0; $i<strlen($digits); $i++) {
			$digit = $digits[$i] * (($i+1)%2+1);
			$sum = array_sum(str_split($digit));
			$checksum += $sum;
		}
		return $checksum % 10;
	}

	public function getCode($eventNumber, $sellerNumber, $itemNumber) {
		$number = sprintf("%02d%03d%02d", $eventNumber, $sellerNumber, $itemNumber);
		return $number . $this->getChecksum($number);
	}
}

?>