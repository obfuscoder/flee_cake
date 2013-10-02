<?php

class Item extends AppModel {
	public $belongsTo = ["Seller", "Category"];
}

?>