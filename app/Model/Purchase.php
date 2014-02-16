<?php

class Purchase extends AppModel {
	public $belongsTo = array("ReservedItem", "Customer");
}

?>