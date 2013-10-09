<?php

class Item extends AppModel {
	public $belongsTo = array("Seller", "Category");

	public $validate = array(
		"description" => array("rule" => array("between", "4", "20"), "message" => "Bitte geben Sie eine sinnvolle Beschreibung mit 4 bis 30 Buchstaben ein."),
		"price" => array("rule" => "notEmpty", "message" => "Bitte geben Sie einen Preis ein.")
	);
}

?>