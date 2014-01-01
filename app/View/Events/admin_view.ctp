<h2>Termindetails</h2>
<dl>
	<dt>Name</dt><dd><?php echo $event['Event']['name'] ?></dd>
	<dt>Datum</dt><dd><?php echo $event['Event']['date'] ?></dd>
	<dt>Maximale Verkäuferzahl</dt><dd><?php echo $event['Event']['max_sellers'] ?></dd>
	<dt>Maximale Artikelzahl pro Verkäufer</dt><dd><?php echo $event['Event']['max_items_per_seller'] ?></dd>
	<dt>Startzeit</dt><dd><?php echo $event['Event']['start_time'] ?></dd>
	<dt>Endzeit</dt><dd><?php echo $event['Event']['end_time'] ?></dd>
	<dt>Reservierungsstart</dt><dd><?php echo $event['Event']['reservation_start'] ?></dd>
	<dt>Reservierungsende</dt><dd><?php echo $event['Event']['reservation_end'] ?></dd>
</dl>
<h3>Reservierungen</h3>
<p><ul>
<?php foreach ($reservations as $reservation): ?>
	<li><?php echo $this->Html->link(
			$reservation["Seller"]["first_name"] . " " . $reservation["Seller"]["last_name"],
			array("controller" => "sellers", "action" => "view", $reservation["Seller"]["id"]))
		?> - Reservierungsnummer <strong><?php echo $reservation["Reservation"]["number"] ?></strong></li>
<?php endforeach; ?>
</ul></p>
<h3>Aktionen</h3>
<p class="actions">
	<?php echo $this->Html->link("Bearbeiten", array('action' => 'edit', $event['Event']['id'])); ?>
	<?php
		if ($event["Event"]["invitation_sent"] === null) {
			echo $this->Html->link("Reservierungseinladungen verschicken", array("action" => "invite", $event['Event']['id']));
		} ?>
	<?php
		if ($event["Event"]["closing_sent"] === null) {
			echo $this->Html->link("Erinnerungsmail vor Bearbeitungsschluss verschicken", array("action" => "mail_closing", $event['Event']['id']));
		} ?>
	<?php
		if ($event["Event"]["closed_sent"] === null) {
			echo $this->Html->link("Bearbeitungsabschlussmail verschicken", array("action" => "mail_closed", $event['Event']['id']));
		} ?>
	<?php echo $this->Html->link("Reservierungen", array("controller" => "reservations", 'action' => 'index', $event['Event']['id'])); ?>
	<?php echo $this->Html->link("Terminliste", array('action' => 'index')); ?>
	<?php
		if (strtotime($event['Event']['reservation_end']) < time()) {
			echo $this->Html->link("Datenexport für diese Veranstaltung", array("action" => "csv", $event['Event']['id']));
	} ?>
	<?php echo $this->Html->link("Neuer Termin", array('action' => 'add')); ?>
</p>
