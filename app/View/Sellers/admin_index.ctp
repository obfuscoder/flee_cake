<?php $this->set("title_for_layout", "Verkäufer") ?>
<table class="table table-condensed table-hover table-striped">
	<tr>
		<th>Name</th>
		<th>Artikel</th>
		<th>Aktiv</th>
        <th>Notify</th>
		<th>Letzte Änderung</th>
		<th class="actions"><?php echo $this->Html->link("Neuer Verkäufer", array("controller" => "sellers", "action" => "new"), array("class" => "btn btn-primary btn-xs")); ?></th>
	</tr>
	<?php foreach ($sellers as $seller): ?>
	<tr>
		<td><a href="mailto:<?php echo $seller["Seller"]["email"] ?>"><?php echo $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] ?></a></td>
		<td><?php echo count($seller["Item"]) ?></td>
		<td><?php echo $seller["Seller"]["active"] ? "ja":"nein" ?></td>
        <td><?php echo $seller["Seller"]["notify"] ? "ja":"nein" ?></td>
		<td><?php echo $this->Time->timeAgoInWords($seller["Seller"]["lastUpdated"], array('format' => 'd.m.Y')) ?></td>
		<td class="actions">
			<?php echo $this->Html->link("Details", array("controller" => "sellers", "action" => "view", $seller["Seller"]['id']), array("class" => "btn btn-primary btn-xs")); ?>
			<?php echo $this->Html->link("Bearbeiten", array("controller" => "sellers", "action" => "edit", $seller["Seller"]['id']), array("class" => "btn btn-primary btn-xs")); ?>
			<?php echo $this->Html->link("Artikel", array("controller" => "items", "action" => "index", $seller["Seller"]['id']), array("class" => "btn btn-primary btn-xs")); ?>
			<?php echo $this->Form->postLink("Löschen", array("controller" => "sellers", "action" => "delete",
					$seller["Seller"]['id']), array("confirm" => "Verkäufer wirklich löschen?", "class" => "btn btn-warning btn-xs")); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($seller); ?>
</table>
