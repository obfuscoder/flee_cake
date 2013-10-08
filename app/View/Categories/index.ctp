<h2><?php echo __("Categories") ?></h2>
<table>
	<tr>
		<th><?php echo __("Name") ?></th>
		<th><?php echo $this->Html->link(__("New category"), array("controller" => "categories", "action" => "create")); ?></th>
	</tr>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo $category["Category"]["name"]; ?></td>
		<td><?php echo $this->Html->link(__("Edit"), array("controller" => "categories", "action" => "update", $category["Category"]['id'])); ?> |
			<?php echo $this->Form->postLink(__("Delete"), array("controller" => "categories", "action" => "delete", $category["Category"]['id']), array("confirm" => __("Are you sure?"))); ?>
	</tr>
	<?php endforeach; ?>
	<?php unset($category); ?>
</table>
