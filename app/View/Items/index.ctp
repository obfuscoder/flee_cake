<h1>Items</h1>
<table>
	<tr>
		<th>Number</th>
		<th>Description</th>
		<th>Category</th>
		<th>Size</th>
		<th>Price</th>
		<th><?php echo $this->Html->link("Add item", array("controller" => "items", "action" => "create", $seller_id)); ?></th>
	</tr>
	<?php foreach ($items as $item): ?>
	<tr>
		<td><?php echo $item["Item"]["seller_id"] + "-" + 12334 ?></td>
		<td><?php echo $item["Item"]["description"]; ?></td>
		<td><?php echo $item["Category"]["name"]; ?></td>
		<td><?php echo $item["Item"]["size"]; ?></td>
		<td><?php echo $this->Number->currency($item["Item"]["price"], "EUR"); ?></td>
		<td><?php echo $this->Html->link("Edit", array("controller" => "items", "action" => "update", $item["Item"]['id'])); ?> |
			<?php echo $this->Form->postLink("Delete", array("controller" => "items", "action" => "delete", $item["Item"]['id']), array("confirm" => "Are you sure?")); ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($item); ?>
</table>

<p><?php echo $this->Html->link("Download PDF", array("controller" => "items", "action" => "pdf", $seller_id)); ?></p>