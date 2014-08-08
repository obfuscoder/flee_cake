<?php
    $this->set("title_for_layout", "Termin bearbeiten");
    define('THREE_YEARS', 3600 * 24 * 365 * 3);
	echo $this->Form->create('Event');
	echo $this->Form->input('id');
	echo $this->Form->input('name');
	echo $this->Form->input('details', array("type" => "textarea"));
    echo $this->Form->date('date', array("min" => date("Y-m-d"), "max" => date("Y-m-d", time() + THREE_YEARS)));
	echo $this->Form->input('date_confirmed');
	echo $this->Form->input('max_sellers');
	echo $this->Form->input('max_items_per_seller');
	echo $this->Form->time('start_time');
	echo $this->Form->time('end_time');
	echo $this->Form->date_time('reservation_start', array("min" => date("Y-m-d"), "max" => date("Y-m-d", time() + THREE_YEARS)));
	echo $this->Form->date_time('reservation_end', array("min" => date("Y-m-d"), "max" => date("Y-m-d", time() + THREE_YEARS)));
	echo $this->Form->date('item_handover_date', array("min" => date("Y-m-d"), "max" => date("Y-m-d", time() + THREE_YEARS)));
	echo $this->Form->time('item_handover_start_time');
	echo $this->Form->time('item_handover_end_time');
	echo $this->Form->date('item_pickup_date', array("min" => date("Y-m-d"), "max" => date("Y-m-d", time() + THREE_YEARS)));
	echo $this->Form->time('item_pickup_start_time');
	echo $this->Form->time('item_pickup_end_time');
	echo $this->Form->end("Speichern");
?>
