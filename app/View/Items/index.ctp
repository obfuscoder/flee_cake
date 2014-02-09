<?php $this->set("title_for_layout", "Artikelübersicht") ?>
<?php $unreservedItemCount = $reservedItemCount = 0 ?>
<p>Hier können Sie Ihre Artikel verwalten.</p>
<?php if ($reservation): ?>
	<p>Sie haben die Reservierungsnummer <strong><?php echo $reservation["Reservation"]["number"] ?></strong>.
	<?php if (strtotime($event["Event"]["reservation_end"]) > time()): ?>
		Alle zu verkaufenden Artikel müssen bis zum <?php echo $this->Time->format($event["Event"]["reservation_end"], "%A, %e. %B %Y um %H:%M Uhr") ?> eingetragen und die Etiketten erzeugt sein.
		<?php if (strtotime($event["Event"]["reservation_end"]) > time()): ?>
			</p><p><strong>Reservierung rückgängig machen:</strong> Sollten Sie nicht mehr als Verkäufer am Flohmarkt teilnehmen können, bitte
			<?php echo $this->Html->link("geben Sie Ihre Reservierung wieder frei",
					array("controller" => "reservations", "action" => "delete", $reservation["Reservation"]['id']),
					array(),
					"Sind Sie sicher, dass Sie die Reservierung freigeben möchten? Sie können damit nicht mehr als Verkäufer an diesem Flohmarkt teilnehmen.") ?>.
		<?php endif ?>
	<?php else: ?>
		Die Frist zum Erzeugen der Etiketten für den Flohmarkt ist abgelaufen. Sie können keine weiteren Etiketten erzeugen. Sie können jedoch die bereits erzeugten Etiketten ausdrucken.
	<?php endif ?>
	</p>
<?php else: ?>
	<p>Sie haben noch keine Reservierungsnummer. <strong>Ein Verkauf ist nur mit Reservierungsnummer möglich</strong>.</p>
	<p>
	<?php if ($event["Event"]["max_sellers"] <= count($event["Reservation"])): ?>
		Leider sind alle Plätze bereits vergeben.
		<?php if ($seller["Seller"]["notify"]): ?>
			Sie stehen auf der Warteliste und bekommen eine Email sobald ein Platz frei wird.
        <?php else: ?>
			<?php echo $this->Form->postLink("Hier", array("controller" => "sellers", "action" => "notify")) ?> können Sie sich auf die Warteliste setzen lassen. Sie erhalten eine Mail sobald ein Platz frei wird.
		<?php endif; ?>
	<?php else: ?>
		<?php if (strtotime($event["Event"]["reservation_start"]) > time()): ?>
			Sie können sich ab <?php echo $this->Time->format($event["Event"]["reservation_start"], "%A, %e. %B %Y um %H:%M Uhr") ?> einen Verkäuferplatz reservieren.
		<?php endif; ?>
		<?php if (strtotime($event["Event"]["reservation_start"]) < time() && strtotime($event["Event"]["reservation_end"]) > time()): ?>
			Sie können sich <?php echo $this->Html->link("hier", array("controller" => "sellers", "action" => "reservation", $seller["Seller"]['token'], $event["Event"]["id"])) ?> einen Verkäuferplatz reservieren.
		<?php endif; ?>
	<?php endif; ?>
	</p>
<?php endif ?>
<?php if (count($items) < $event["Event"]["max_items_per_seller"]): ?>
<p>Sie haben aktuell <strong><?php echo count($items) ?></strong> Artikel angelegt.
Sie können noch <strong><?php echo $event["Event"]["max_items_per_seller"] - count($items) ?></strong> weitere Artikel anlegen.</p>
<p class="actions">
	<?php echo $this->Html->link("Artikel hinzufügen", array("controller" => "items", "action" => "create", $seller["Seller"]["id"])); ?></p>
<?php endif; ?>
<table>
	<tr>
		<th>Position</th>
		<th>Beschreibung</th>
		<th>Kategorie</th>
		<th>Größe</th>
		<th>Preis</th>
		<th>verkauft</th>
		<th>Aktionen</th>
	</tr>
	<?php for ($i=0; $i<count($items); $i++): ?>
	<?php $item = $items[$i] ?>
	<tr<?php if($item["Reservation"][0]["ReservedItem"]["sold"] != null) echo ' class="sold"' ?>>
		<td><?php echo $i+1 ?></td>
		<td><?php echo $item["Item"]["description"]; ?></td>
		<td><?php echo $item["Category"]["name"]; ?></td>
		<td><?php echo $item["Item"]["size"]; ?></td>
		<td><?php echo $this->Number->currency($item["Item"]["price"], "EUR"); ?></td>
		<td><?php echo $item["Reservation"][0]["ReservedItem"]["sold"] != null ? "ja":"nein" ?></td>
		<td class="actions">
			<?php
				if (!$item["Reservation"]) {
					$unreservedItemCount++;
					echo $this->Html->link("Bearbeiten", array("controller" => "items", "action" => "update", $item["Item"]['id']));
					echo $this->Form->postLink("Löschen", array("controller" => "items", "action" => "delete", $item["Item"]['id']),
							array("confirm" => "Sind Sie sicher, dass Sie diesen Artikel löschen wollen?"));
				} else {
					$reservedItemCount++; ?>
					Etikett mit Nummer <strong><?php echo $reservation['Reservation']['number'] . "-" . $item['Reservation'][0]['ReservedItem']['number'] ?></strong> erzeugt <?php
				} ?>
		</td>
					
	</tr>
	<?php endfor; ?>
	<?php unset($item); ?>
</table>
<?php if (count($items)): ?>
<p>Sobald Sie eine Reservierungsnummer erhalten haben, können Sie die Etiketten für die Artikel erzeugen und drucken. Bitte beachten Sie, dass das Erzeugen von Etiketten die bis zu diesem Zeitpunkt angelegten Artikel zur weiteren Bearbeitung sperrt.</p>
<p class="actions"><?php
	if ($reservation && $unreservedItemCount && strtotime($event["Event"]["reservation_end"]) > time()) {
		echo $this->Html->link("$unreservedItemCount Etikett(en) erzeugen",
			array("action" => "label", $reservation["Reservation"]["id"]),
			array(), "Sobald Sie die Etiketten erzeugen, werden alle bis zu diesem Zeitpunkt eingegebenen Artikel gesperrt. " .
			"Sie können diese Artikel nicht mehr bearbeiten. Sie können jedoch danach noch weitere Artikel hinzufügen. " .
			"Wollen Sie die Etiketten erzeugen lassen und damit die aktuellen Artikel sperren?");
		echo "&nbsp";
	}
	if ($reservation && $reservation["Item"]) {
		echo $this->Html->link("$reservedItemCount erzeugte Etiketten ausdrucken", array("action" => "pdf", $reservation["Reservation"]["id"]));
	} ?></p>
 <p><small>Die Etiketten werden als PDF-Dokument generiert.
 	Zum Anzeigen und Ausdrucken von PDF-Dateien benötigen Sie ein entsprechendes Programm.
 	Falls noch nicht vorhanden, installieren Sie sich bitte ein dazu passendes Programm.
 	Wir empfehlen den <a href="http://get.adobe.com/reader/">Adobe Acrobat Reader</a>
 	oder den <a href="http://www.foxitsoftware.com/Secure_PDF_Reader/">FoxIt Reader</a>.</small></p>
<?php endif; ?>