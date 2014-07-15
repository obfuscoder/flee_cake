<?php $this->set("title_for_layout", "Artikel anlegen/bearbeiten") ?>
<?php
	echo $this->Form->create("Item");
	echo $this->Form->hidden("id");
	echo $this->Form->hidden("seller_id");
	echo $this->Form->input("description");
	echo $this->Form->input("category_id", array("options" => $categories, "empty" => "[Bitte wählen]"));
	echo $this->Form->input("size");
	echo $this->Form->input("price", array("label" => "Preis (in € mit 10 Cent Genauigkeit)", "type" => "text"));
	echo $this->Form->submitButton("Speichern");
	echo $this->Html->cancelLink("Zurück", array('action' => 'index', $this->request->data["Item"]["seller_id"]));
	echo ($this->Form->end());
?>
