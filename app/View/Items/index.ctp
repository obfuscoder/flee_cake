<h2><?php echo __("Items") ?></h2>
<table>
	<tr>
		<th><?php echo __("Number") ?></th>
		<th><?php echo __("Description") ?></th>
		<th><?php echo __("Category") ?></th>
		<th><?php echo __("Size") ?></th>
		<th><?php echo __("Price") ?></th>
		<th><?php if (count($items) < 50) echo $this->Html->link(__("Add item"), array("controller" => "items", "action" => "create", $seller_id)); ?></th>
	</tr>
	<?php for ($i=0; $i<count($items); $i++): ?>
	<tr>
		<?php $item = $items[$i]; ?>
		<td><?php echo $i+1 ?></td>
		<td><?php echo $item["Item"]["description"]; ?></td>
		<td><?php echo $item["Category"]["name"]; ?></td>
		<td><?php echo $item["Item"]["size"]; ?></td>
		<td><?php echo $this->Number->currency($item["Item"]["price"], "EUR"); ?></td>
		<td><?php echo $this->Html->link(__("Edit"), array("controller" => "items", "action" => "update", $item["Item"]['id'])); ?> |
			<?php echo $this->Form->postLink(__("Delete"), array("controller" => "items", "action" => "delete", $item["Item"]['id']), array("confirm" => __("Are you sure?"))); ?></td>
	</tr>
	<?php endfor; ?>
	<?php unset($item); ?>
</table>

<p><?php echo $this->Html->link(__("Download PDF"), array("controller" => "items", "action" => "pdf", $seller_id)); ?></p>