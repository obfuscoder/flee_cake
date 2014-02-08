<?php $this->set("title_for_layout", "Reservierungen") ?>
<table>
	<tr>
		<th>Nummer</th>
		<th>Name</th>
		<th>eMail</th>
		<th>Artikel</th>
		<th>Aktionen</th>
	</tr>
	<?php foreach ($reservations as $reservation): ?>
	<tr>
		<td><?php echo $reservation["Reservation"]["number"] ?></td>
		<td><?php echo $this->Html->link(
				$reservation["Seller"]["first_name"] . " " . $reservation["Seller"]["last_name"],
				array("controller" => "sellers", "action" => "view", $reservation["Seller"]["id"])) ?></td>
		<td><?php echo $reservation["Seller"]["email"] ?></td>
		<td><?php echo count($reservation["Item"]) ?></td>
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
		foreach($sellers as $k=>&$seller) {
			$seller = $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] . " (" . $seller["Seller"]["email"] . ") - " . count($seller['Item']);
		}
		echo $this->Form->create('Reservation', array("action" => "create"));
		echo $this->Form->hidden('event_id', array("value" => $event_id));
		echo $this->Form->select("seller_id", $sellers, array("empty" => false, "label" => "Verkäufer reservieren"));
		echo $this->Form->end("Reservieren");
	}
?>
<p><?php echo $this->Html->link("Hauptseite", array("controller" => "admin", "action" => "index")); ?></p>
