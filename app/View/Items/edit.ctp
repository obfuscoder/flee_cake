<h1>Create/Edit item</h1>
<?php
	echo $this->Form->create("Item");
	echo $this->Form->hidden("id");
	echo $this->Form->hidden("seller_id");
	echo $this->Form->input("description");
	echo $this->Form->input("category_id", $categories);
	echo $this->Form->input("size");
	echo $this->Form->input("price");
	echo $this->Form->end("Save");
?>
