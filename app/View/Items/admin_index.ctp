<?php $this->set("title_for_layout", "Artikelübersicht") ?>
<?php $unreservedItemCount = $reservedItemCount = 0 ?>
<p>Es sind aktuell <strong><?php echo count($items) ?></strong> Artikel angelegt.</p>
<p class="actions">
	<?php echo $this->Html->buttonLink("Artikel hinzufügen", array("controller" => "items", "action" => "create", $seller["Seller"]["id"])); ?></p>
<?php if ($reservation): ?>
	<p>Die Reservierungsnummer ist <strong><?php echo $reservation["Reservation"]["number"] ?></strong>.
	</p>
<?php else: ?>
	<p>Es gibt noch keine Reservierungsnummer.</p>
<?php endif ?>
<table class="table table-condensed table-hover table-striped">
	<tr>
		<th>Position</th>
		<th>Beschreibung</th>
		<th>Kategorie</th>
		<th>Größe</th>
		<th>Preis</th>
		<th>verkauft am</th>
		<th>Aktionen</th>
	</tr>
	<?php for ($i=0; $i<count($items); $i++): ?>
	<tr>
		<?php $item = $items[$i] ?>
		<td><?php echo $i+1 ?></td>
		<td><?php echo $item["Item"]["description"]; ?></td>
		<td><?php echo $item["Category"]["name"]; ?></td>
		<td><?php echo $item["Item"]["size"]; ?></td>
		<td><?php echo $this->Number->currency($item["Item"]["price"], "EUR"); ?></td>
		<td><?php echo ($item["Reservation"]) ? $item["Reservation"][0]["ReservedItem"]["sold"] : "" ?></td>
		<td class="actions">
			<?php
				if (!$item["Reservation"]) {
					$unreservedItemCount++; ?>
					<?php echo $this->Html->link("Bearbeiten", array("controller" => "items", "action" => "update", $item["Item"]['id']), array("class" => "btn btn-primary btn-xs")); ?>
					<?php echo $this->Form->postLink("Löschen", array("controller" => "items", "action" => "delete", $item["Item"]['id'] ),
							array("confirm" => "Sind Sie sicher, dass Sie diesen Artikel löschen wollen?", "class" => "btn btn-warning btn-xs")); ?>
<?php							
				} else {
					$reservedItemCount++; ?>
					Etikett mit Nummer <strong><?php echo $reservation['Reservation']['number'] . "-" . $item['Reservation'][0]['ReservedItem']['number'] ?></strong> erzeugt.<?php
				} ?>
		</td>
					
	</tr>
	<?php endfor; ?>
	<?php unset($item); ?>
</table>
<?php if (count($items)): ?>
<p>Sobald eine Reservierungsnummer vergeben wurde, können die Etiketten für die Artikel erzeugt und gedruckt werden.</p>
<p class="actions"><?php
	if ($reservation && $unreservedItemCount) {
		echo $this->Html->buttonLink("$unreservedItemCount Etikett(en) erzeugen",
			array("action" => "label", $reservation["Reservation"]["id"]),
			array(), "Sobald Sie die Etiketten erzeugen, werden alle bis zu diesem Zeitpunkt eingegebenen Artikel gesperrt. " .
			"Sie können diese Artikel nicht mehr bearbeiten. Sie können jedoch danach noch weitere Artikel hinzufügen. " .
			"Wollen Sie die Etiketten erzeugen lassen und damit die aktuellen Artikel sperren?");
		echo "&nbsp";
	}
	if ($reservation && $reservation["Item"]) {
		echo $this->Html->buttonLink("$reservedItemCount erzeugte Etiketten ausdrucken", array("action" => "pdf", $reservation["Reservation"]["id"]));
	} ?></p>
<?php endif; ?>

