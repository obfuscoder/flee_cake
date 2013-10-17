<h2><?php echo __("Sellers") ?></h2>
	<?php debug($this->Time->timeAgoInWords("2014-05-14", array('format' => 'l, M.Y'))) ?>
<table>
	<tr>
		<th>Vorname</th>
		<th>Nachname</th>
		<th>eMail</th>
		<th>Artikel</th>
		<th>Registriert</th>
		<th>Aktiviert</th>
		<th>Letzte Änderung</th>
		<th class="actions"><?php echo $this->Html->link("Neue Registrierung", array("controller" => "sellers", "action" => "register")); ?></th>
	</tr>
	<?php foreach ($sellers as $seller): ?>
	<tr>
		<td><?php echo $seller["Seller"]["first_name"]; ?></td>
		<td><?php echo $seller["Seller"]["last_name"]; ?></td>
		<td><?php echo $seller["Seller"]["email"]; ?></td>
		<td><?php echo count($seller["Item"]) ?></td>
		<td><?php echo $this->Time->timeAgoInWords($seller["Seller"]["created"], array('format' => 'd.m.Y')) ?></td>
		<td><?php echo $seller["Seller"]["active"] ? "ja":"nein" ?></td>
		<td><?php echo $this->Time->timeAgoInWords($seller["Seller"]["lastUpdated"], array('format' => 'd.m.Y')) ?></td>
		<td class="actions"><?php echo $this->Html->link("Details", array("controller" => "sellers", "action" => "view", $seller["Seller"]['id'])); ?>
			<?php echo $this->Html->link("Artikel", array("controller" => "items", "action" => "index", $seller["Seller"]['id'])); ?>
			<?php echo $this->Form->postLink("Löschen", array("controller" => "sellers", "action" => "delete",
					$seller["Seller"]['id']), array("confirm" => "Verkäufer wirklich löschen?")); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($seller); ?>
</table>
<p><?php echo $this->Html->link("Kategorien", array("controller" => "categories", "action" => "index")); ?></p>