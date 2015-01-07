<?php

class Review extends AppModel {
	public $belongsTo = array("Seller", "Event");
}
