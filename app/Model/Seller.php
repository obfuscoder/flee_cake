<?php

class Seller extends AppModel {
	public $validate = array(
		"firstname" => "notEmpty",
		"lastname" => "notEmpty",
		"street" => "notEmpty",
		"zipcode" => array(
			"rule" => array("between", 5, 5),
			"message" => "postal code may only consist of 5 digits"
		),
		"city" => "notEmpty",
		"phone" => "numeric",
		"email" => "email"
	);
}

?>