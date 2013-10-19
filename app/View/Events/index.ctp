<div>
	<h2>Termine</h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('reservation_start'); ?></th>
			<th class="actions"><?php echo $this->Html->link("Neuer Termin", array('action' => 'add')); ?></th>
	</tr>
	<?php foreach ($events as $event): ?>
	<tr>
		<td><?php echo h($event['Event']['name']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['date']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['reservation_start']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link("Anzeigen", array('action' => 'view', $event['Event']['id'])); ?>
			<?php echo $this->Html->link("Bearbeiten", array('action' => 'edit', $event['Event']['id'])); ?>
			<?php echo $this->Form->postLink("Löschen", array('action' => 'delete', $event['Event']['id']), null,
				"Wollen Sie wirklich diesen Eintrag löschen? Die Flohmarktnummer geht dabei verloren.", $event['Event']['id']); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p><?php echo $this->Paginator->counter(array('format' => "Seite {:page} von {:pages}")); ?></p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . "< Seite zurück", array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next("Nächste Seite >", array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

