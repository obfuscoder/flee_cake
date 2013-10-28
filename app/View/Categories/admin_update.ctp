<h2>Kategorie bearbeiten</h2>
<?php
	echo $this->Form->create("Category");
	echo $this->Form->input("name", array("label" => "Name"));
	echo $this->Form->end("Speichern");
?>
