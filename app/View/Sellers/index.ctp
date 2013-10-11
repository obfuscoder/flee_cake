<h2><?php echo __("Sellers") ?></h2>
<table>
	<tr>
		<th>Vorname</th>
		<th>Nachname</th>
		<th>eMail</th>
		<th>Artikel</th>
		<th>Registriert</th>
		<th>Letzte Änderung</th>
		<th><?php echo $this->Html->link("Neue Registrierung", array("controller" => "sellers", "action" => "register")); ?></th>
	</tr>
	<?php foreach ($sellers as $seller): ?>
	<tr>
		<td><?php echo $seller["Seller"]["first_name"]; ?></td>
		<td><?php echo $seller["Seller"]["last_name"]; ?></td>
		<td><?php echo $seller["Seller"]["email"]; ?></td>
		<td><?php echo count($seller["Item"]) ?></td>
		<td><?php echo $seller["Seller"]["created"] ?></td>
		<td><?php
		$lastupdated = null;
	foreach ($seller["Item"] as $item) {
		if ($lastupdated === null or $lastupdated < $item["modified"]) {
			$lastupdated = $item["modified"];
		}
	}
	echo $lastupdated ?></td>
		<td><?php echo $this->Html->link("Details", array("controller" => "sellers", "action" => "view", $seller["Seller"]['id'])); ?> |
			<?php echo $this->Form->postLink("Löschen", array("controller" => "sellers", "action" => "delete",
					$seller["Seller"]['id']), array("confirm" => "Verkäufer wirklich löschen?")); ?> |
			<?php echo $this->Html->link("Artikel", array("controller" => "items", "action" => "index", $seller["Seller"]['id'])); ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($seller); ?>
</table>
<p><?php echo $this->Html->link("Kategorien", array("controller" => "categories", "action" => "index")); ?></p>