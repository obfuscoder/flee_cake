<h2>Kategorien</h2>
<table>
	<tr>
		<th>Name</th>
		<td class="actions"><?php echo $this->Html->link("Neue Kategorie", array("controller" => "categories", "action" => "create")); ?></td>
	</tr>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo $category["Category"]["name"]; ?></td>
		<td class="actions"><?php echo $this->Html->link("Bearbeiten", array("controller" => "categories", "action" => "update", $category["Category"]['id'])); ?>
			<?php echo $this->Form->postLink("Löschen", array("controller" => "categories", "action" => "delete", $category["Category"]['id']), array("confirm" => "Soll die Kategorie wirklich gelöscht werden?")); ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($category); ?>
</table>
<p><?php echo $this->Html->link("Hauptseite", array("controller" => "admin", "action" => "index")); ?></p>
