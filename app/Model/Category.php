<?php

class Category extends AppModel {
	public $hasMany = "Item";

	public $validate = array(
		"first_name" => "notEmpty"
	);
}

?>