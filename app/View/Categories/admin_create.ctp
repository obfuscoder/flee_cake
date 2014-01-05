<?php $this->set("title_for_layout", "Kategorie erstellen") ?>
<?php
	echo $this->Form->create("Category");
	echo $this->Form->input("name", array("label" => "Name"));
	echo $this->Form->end("Speichern");
?>
