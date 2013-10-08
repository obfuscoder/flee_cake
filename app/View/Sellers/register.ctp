<h2><?php echo __("Register seller") ?></h2>
<?php
	echo $this->Form->create("Seller");
	echo $this->Form->input("first_name", array("label" => __("first name")));
	echo $this->Form->input("last_name", array("label" => __("last name")));
	echo $this->Form->input("street", array("label" => __("street")));
	echo $this->Form->input("zip_code", array("label" => __("zip code")));
	echo $this->Form->input("city", array("label" => __("city")));
	echo $this->Form->input("phone", array("label" => __("phone number")));
	echo $this->Form->input("email", array("label" => __("email")));
	echo $this->Form->end(__("Register"));
?>
