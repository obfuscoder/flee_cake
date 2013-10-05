<h1><?php echo __("Register seller") ?></h1>
<?php
	echo $this->Form->create("Seller");
	echo $this->Form->input("firstname");
	echo $this->Form->input("lastname");
	echo $this->Form->input("street");
	echo $this->Form->input("zipcode");
	echo $this->Form->input("city");
	echo $this->Form->input("phone");
	echo $this->Form->input("email");
	echo $this->Form->end(__("Register"));
?>
