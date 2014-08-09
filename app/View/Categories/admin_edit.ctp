<?php $this->set("title_for_layout", "Kategorie bearbeiten") ?>
<?php
	echo $this->Form->create("Category");
	echo $this->Form->input("name", array("label" => "Name"));
	echo $this->Form->end("Speichern");
?>
