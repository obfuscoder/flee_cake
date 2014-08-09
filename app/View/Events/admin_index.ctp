<?php $this->set("title_for_layout", "Termine") ?>
<div>
	<table class="table table-condensed table-hover table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('reservation_start'); ?></th>
			<th class="actions"><?php echo $this->Html->link("Neuer Termin", array('action' => 'add'), array("class" => "btn btn-primary btn-xs")); ?></th>
	</tr>
	<?php foreach ($events as $event): ?>
	<tr>
		<td><?php echo h($event['Event']['name']); ?></td>
		<td><?php echo h($event['Event']['date']); ?></td>
		<td><?php echo h($event['Event']['reservation_start']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link("Anzeigen", array('action' => 'view', $event['Event']['id']), array("class" => "btn btn-primary btn-xs")); ?>
			<?php echo $this->Html->link("Bearbeiten", array('action' => 'edit', $event['Event']['id']), array("class" => "btn btn-primary btn-xs")); ?>
			<?php echo $this->Form->postLink("Löschen", array('action' => 'delete', $event['Event']['id']),
				array("confirm" => "Wollen Sie wirklich diesen Eintrag löschen? Die Flohmarktnummer geht dabei verloren.", $event['Event']['id'], "class" => "btn btn-warning btn-xs")); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
