<?php

class Item extends AppModel {
	public $belongsTo = array("Seller", "Category");
}

?>