<?php $this->set("title_for_layout", "Artikel anlegen/bearbeiten") ?>
<?php
	echo $this->Form->create("Item");
	echo $this->Form->hidden("id");
	echo $this->Form->hidden("seller_id");
	echo $this->Form->input("description", array("label" => __("description")));
	echo $this->Form->input("category_id", array("options" => $categories, "label" => __("category")));
	echo $this->Form->input("size", array("label" => __("size")));
	echo $this->Form->input("price", array("label" => "Preis (in € mit 10 Cent Genauigkeit)", "type" => "text"));
	echo $this->Form->end(__("Save"));
	echo $this->Html->link("Zurück", array('action' => 'index', $this->request->data["Item"]["seller_id"]));
?>
