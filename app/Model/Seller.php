<?php

class Seller extends AppModel {
	public $hasMany = "Item";

	public $validate = array(
		"first_name" => "notEmpty",
		"last_name" => "notEmpty",
		"street" => "notEmpty",
		"zip_code" => array(
			"rule" => array("between", 5, 5),
			"message" => "postal code may only consist of 5 digits"
		),
		"city" => "notEmpty",
		"phone" => "numeric",
		"email" => "email"
	);
}

?>