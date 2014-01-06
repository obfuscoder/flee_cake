<?php $this->set("title_for_layout", "Termin bearbeiten") ?>
<?php
	echo $this->Form->create('Event');
	echo $this->Form->input('id');
	echo $this->Form->input('name', array("label" => "Name"));
	echo $this->Form->input('details', array("label" => "Details", "type" => "textarea"));
	echo $this->Form->input('date', array("label" => "Datum", "dateFormat" => "DMY", "minYear" => date("Y"), "maxYear" => date("Y") + 3));
	echo $this->Form->input('date_confirmed', array("label" => "exakte Daten bekannt"));
	echo $this->Form->input('max_sellers', array("label" => "Maximale Anzahl Verkäufer"));
	echo $this->Form->input('max_items_per_seller', array("label" => "Maximale Anzahl Artikel pro Verkäufer"));
	echo $this->Form->input('start_time', array("label" => "Startzeit", "timeFormat" => "24", "interval" => 15));
	echo $this->Form->input('end_time', array("label" => "Endezeit", "timeFormat" => "24", "interval" => 15));
	echo $this->Form->input('reservation_start', array("label" => "Reservierungsstart", "dateFormat" => "DMY", "minYear" => date("Y"), "maxYear" => date("Y") + 3, "timeFormat" => "24", "interval" => 15));
	echo $this->Form->input('reservation_end', array("label" => "Reservierungsende", "dateFormat" => "DMY", "minYear" => date("Y"), "maxYear" => date("Y") + 3, "timeFormat" => "24", "interval" => 15));
	echo $this->Form->input('item_handover_date', array("label" => "Warenannahme", "dateFormat" => "DMY", "minYear" => date("Y"), "maxYear" => date("Y") + 3));
	echo $this->Form->input('item_handover_start_time', array("label" => "Start", "timeFormat" => "24", "interval" => 15));
	echo $this->Form->input('item_handover_end_time', array("label" => "Ende", "timeFormat" => "24", "interval" => 15));
	echo $this->Form->input('item_pickup_date', array("label" => "Warenabholung", "dateFormat" => "DMY", "minYear" => date("Y"), "maxYear" => date("Y") + 3));
	echo $this->Form->input('item_pickup_start_time', array("label" => "Start", "timeFormat" => "24", "interval" => 15));
	echo $this->Form->input('item_pickup_end_time', array("label" => "Ende", "timeFormat" => "24", "interval" => 15));
	echo $this->Form->end("Speichern");
?>
<h3>Aktionen</h3>
<p class="actions">
	<?php echo $this->Html->link("Terminliste", array('action' => 'index')); ?>
</p>
