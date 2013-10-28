<h2>Artikel bearbeiten</h2>
<?php
	echo $this->Form->create("Item");
	echo $this->Form->hidden("id");
	echo $this->Form->hidden("seller_id");
	echo $this->Form->input("description", array("label" => __("description")));
	echo $this->Form->input("category_id", array("options" => $categories, "label" => __("category")));
	echo $this->Form->input("size", array("label" => __("size")));
	echo $this->Form->input("price", array("label" => "Preis (in € mit 10 Cent Genauigkeit)", "min" => "0.10", "max" => "200", "step" => "0.10"));
	echo $this->Form->end("Speichern");
	echo $this->Html->link("Zurück", array('action' => 'index', $this->request->data["Item"]["seller_id"]));
?>
