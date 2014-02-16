<?php

class ZipCode extends AppModel {
	public $hasMany = array("Seller","Customer");
}

?>