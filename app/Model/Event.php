<?php
App::uses('AppModel', 'Model');

class Event extends AppModel {
	public $hasMany = array(
		"Reservation",
		"Review"
	);

	public $displayField = 'name';

	public $validate = array(
		'name' => array('notEmpty'),
		'date' => array('date', 'notEmpty'),
		'max_sellers' => array('numeric', 'notEmpty'),
		'max_items_per_seller' => array('requiredForCommission'),
		'start_time' => array('time'),
		'end_time' => array('time'),
		'reservation_start' => array('datetime'),
		'reservation_end' => array('datetime'),
	);

	public function getCurrent() {
		return $this->find("first", array(
        	'conditions' => array('current' => 1)
    	));
	}

	public function getReservable($sellerId) {
		return $this->find("all", array("conditions" => array(
            "now() between Event.reservation_start and Event.reservation_end",
            "Event.id not in (select event_id from reservations where reservations.seller_id = $sellerId)")));
	}

	public function getFutureWithSentInvitation() {
		return $this->find("all", array("conditions" => array(
			"now() < Event.reservation_start",
			"Event.invitation_sent is not null")));
	}

    public function requiredForCommission($check) {
        return $this->data["Event"]["type"] != "commission" || Validation::numeric(array_shift($check));
    }
}
