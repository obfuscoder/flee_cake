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