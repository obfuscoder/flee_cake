<h2><?php echo __("Sellers") ?></h2>
<table>
	<tr>
		<th><?php echo __("First name") ?></th>
		<th><?php echo __("Last name") ?></th>
		<th><?php echo __("eMail") ?></th>
		<th>&nbsp;</th>
	</tr>
	<?php foreach ($sellers as $seller): ?>
	<tr>
		<td><?php echo $seller["Seller"]["first_name"]; ?></td>
		<td><?php echo $seller["Seller"]["last_name"]; ?></td>
		<td><?php echo $seller["Seller"]["email"]; ?></td>
		<td><?php echo $this->Html->link(__("Details"), array("controller" => "sellers", "action" => "view", $seller["Seller"]['id'])); ?> |
			<?php echo $this->Form->postLink(__("Delete"), array("controller" => "sellers", "action" => "delete", $seller["Seller"]['id']), array("confirm" => __("Are you sure?"))); ?> |
			<?php echo $this->Html->link(__("Items"), array("controller" => "items", "action" => "index", $seller["Seller"]['id'])); ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($seller); ?>
</table>
<?php echo $this->Html->link(__("Register new seller"), array("controller" => "sellers", "action" => "register")); ?>
<p><?php echo $this->Html->link(__("Categories"), array("controller" => "categories", "action" => "index")); ?></p>