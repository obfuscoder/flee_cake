<?php

class Customer extends AppModel {
	public $belongsTo = array("ZipCode" => array("foreignKey" => "zip_code"));
	public $hasMany = "Purchase";
}

?>