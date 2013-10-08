<h2><?php echo __("Create/Edit item") ?></h2>
<?php
	echo $this->Form->create("Item");
	echo $this->Form->hidden("id");
	echo $this->Form->hidden("seller_id");
	echo $this->Form->input("description", array("label" => __("description")));
	echo $this->Form->input("category_id", array("options" => $categories, "label" => __("category")));
	echo $this->Form->input("size", array("label" => __("size")));
	echo $this->Form->input("price", array("label" => __("price")));
	echo $this->Form->end(__("Save"));
?>
