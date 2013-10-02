<h1>Sellers</h1>
<table>
	<tr>
		<th>First name</th>
		<th>Last name</th>
		<th>eMail</th>
		<th>&nbsp;</th>
	</tr>
	<?php foreach ($sellers as $seller): ?>
	<tr>
		<td><?php echo $seller["Seller"]["first_name"]; ?></td>
		<td><?php echo $seller["Seller"]["last_name"]; ?></td>
		<td><?php echo $seller["Seller"]["email"]; ?></td>
		<td><?php echo $this->Html->link("Details", array("controller" => "sellers", "action" => "view", $seller["Seller"]['id'])); ?> |
			<?php echo $this->Form->postLink("Delete", array("controller" => "sellers", "action" => "delete", $seller["Seller"]['id']), array("confirm" => "Are you sure?")); ?> |
			<?php echo $this->Html->link("Items", array("controller" => "items", "action" => "index", $seller["Seller"]['id'])); ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($seller); ?>
</table>
<?php echo $this->Html->link("Register new seller", array("controller" => "sellers", "action" => "register")); ?>