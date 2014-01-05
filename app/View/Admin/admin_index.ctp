<?php $this->set("title_for_layout", "Adminbereich") ?>
<p class="actions">
	<?php echo $this->Html->link("Termine", array("controller" => "events", "action" => "index")); ?>
	<?php echo $this->Html->link("Verkäufer", array("controller" => "sellers", "action" => "index")); ?>
	<?php echo $this->Html->link("Kategorien", array("controller" => "categories", "action" => "index")); ?>
</p>
