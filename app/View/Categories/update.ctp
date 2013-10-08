<h2><?php echo __("Update category") ?></h2>
<?php
	echo $this->Form->create("Category");
	echo $this->Form->hidden("id");
	echo $this->Form->input("name", array("label" => __("name")));
	echo $this->Form->end(__("Save"));
?>
