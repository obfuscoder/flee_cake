<?php $this->set("title_for_layout", "Kategorien") ?>
<table class="table table-condensed table-hover table-striped">
	<tr>
		<th>Name</th>
		<td class="actions"><?php echo $this->Html->link("Neue Kategorie", array("controller" => "categories", "action" => "create"), array("class" => "btn btn-primary btn-xs")); ?></th>
	</tr>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo $category["Category"]["name"]; ?></td>
		<td class="actions"><?php echo $this->Html->link("Bearbeiten", array("controller" => "categories", "action" => "update", $category["Category"]['id']), array("class" => "btn btn-primary btn-xs")); ?>
			<?php echo $this->Form->postLink("Löschen", array("controller" => "categories", "action" => "delete", $category["Category"]['id']), array("confirm" => "Soll die Kategorie wirklich gelöscht werden?", "class" => "btn btn-warning btn-xs")); ?>
	</tr>
	<?php endforeach; ?>
	<?php unset($category); ?>
</table>
