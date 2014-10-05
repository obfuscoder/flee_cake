<?php

class Reservation extends AppModel {
	public $belongsTo = array(
		"Seller",
		"Event"
	);
	public $hasAndBelongsToMany = array("Item" => array("with" => "ReservedItem", "unique" => "keepExisting", "order" => "ReservedItem.number"));

    public $validate = array(
        "number" => array("rule" => "notEmpty", "message" => "Bitte wählen Sie einen Platz aus."),
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
        $this->create();
        if (!isset($reservation["number"])) {
            $nextReservationNumber = $this->getNextReservationNumber($reservation["event_id"]);
            $reservation["number"] = $nextReservationNumber;
        }
		if ($this->save($reservation)) {
			$this->sendConfirmation();
			return $reservation["number"];
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

    public function getAvailableNumbers($event) {
        $reservations = $this->find('list', array('fields' => array('Reservation.number'),
            'conditions' => array('Reservation.event_id' => $event["Event"]["id"]), 'recursive' => 0));
        $available_numbers = array();
        for($i=1; $i<=$event["Event"]["max_sellers"]; $i++) {
            if (!in_array($i, $reservations)) {
                $available_numbers[$i] = $i;
            }
        }
        return $available_numbers;
    }
}

?>