<h2>Reservierungen</h2>
<table>
	<tr>
		<th>Nummer</th>
		<th>Verkäufer</th>
		<th>Aktionen</th>
	</tr>
	<?php foreach ($reservations as $reservation): ?>
	<tr>
		<td><?php echo $reservation["Reservation"]["number"] ?></td>
		<td><?php echo $this->Html->link(
				$reservation["Seller"]["first_name"] . " " . $reservation["Seller"]["last_name"],
				array("controller" => "sellers", "action" => "view", $reservation["Seller"]["id"])) ?></td>
		<td class="actions">
			<?php echo $this->Form->postLink("Löschen", array("action" => "delete", $reservation["Reservation"]['id']),
					array("confirm" => "Sind Sie sicher, dass Sie diese Reservierung löschen wollen?")); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($reservation); ?>
</table>
<?php
	if (count($sellers) > 0) {
		echo $this->Form->create('Reservation', array("action" => "create"));
		echo $this->Form->hidden('event_id', array("value" => $event_id));
		echo $this->Form->input("seller_id", array("label" => "Verkäufer reservieren"));
		echo $this->Form->end("Reservieren");
	}
?>
