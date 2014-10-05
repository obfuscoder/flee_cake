<?php $this->set("title_for_layout", "Termindetails") ?>
<dl>
	<dt>Name</dt><dd><?php echo $event['Event']['name'] ?></dd>
	<dt>Datum</dt><dd><?php echo $event['Event']['date'] ?></dd>
    <dt>Beschreibung</dt><dd><?php echo $event['Event']['details'] ?></dd>
    <dt>Typ</dt><dd><?php echo $event['Event']['type'] == "commission" ? "Kommissionsflohmarkt" : "Tischflohmarkt" ?></dd>
    <dt>Startzeit</dt><dd><?php echo $event['Event']['start_time'] ?></dd>
    <dt>Endzeit</dt><dd><?php echo $event['Event']['end_time'] ?></dd>
	<dt>Reservierungsstart</dt><dd><?php echo $event['Event']['reservation_start'] ?></dd>
	<dt>Reservierungsende</dt><dd><?php echo $event['Event']['reservation_end'] ?></dd>
    <dt>Maximale Verkäuferzahl</dt><dd><?php echo $event['Event']['max_sellers'] ?></dd>
    <?php if ($event['Event']['type'] == "commission") : ?>
    <dt>Maximale Artikelzahl pro Verkäufer</dt><dd><?php echo $event['Event']['max_items_per_seller'] ?></dd>
	<dt>Übergabedatum</dt><dd><?php echo $event['Event']['item_handover_date'] ?></dd>
	<dt>von</dt><dd><?php echo $event['Event']['item_handover_start_time'] ?></dd>
	<dt>bis</dt><dd><?php echo $event['Event']['item_handover_end_time'] ?></dd>
	<dt>Abholdatum</dt><dd><?php echo $event['Event']['item_pickup_date'] ?></dd>
	<dt>von</dt><dd><?php echo $event['Event']['item_pickup_start_time'] ?></dd>
	<dt>bis</dt><dd><?php echo $event['Event']['item_pickup_end_time'] ?></dd>
    <?php endif ?>
	<dt>Reservierungen</dt><dd><?php echo count($reservations) ?></dd>
</dl>
<h3>Aktionen</h3>
<p class="actions">
	<?php echo $this->Html->buttonLink("Bearbeiten", array('action' => 'edit', $event['Event']['id'])); ?>
	<?php echo $this->Html->buttonLink("Reservierungen", array("controller" => "reservations", 'action' => 'index', $event['Event']['id'])); ?>
</p>
<p class="actions">
	<?php
		if ($event["Event"]["invitation_sent"] === null && strtotime($event["Event"]["reservation_start"]) > time()) {
			echo $this->Html->buttonLink("Reservierungseinladungen verschicken", array("action" => "invite", $event['Event']['id']));
		} ?>
    <?php if ($event['Event']['type'] == "commission") : ?>
	<?php
		if ($event["Event"]["type"] == "commission" &&
            $event["Event"]["closing_sent"] === null &&
            strtotime($event["Event"]["reservation_start"]) < time() &&
            strtotime($event["Event"]["reservation_end"]) > time()) {
			echo $this->Html->buttonLink("Erinnerungsmail vor Bearbeitungsschluss verschicken", array("action" => "mail_closing", $event['Event']['id']));
		} ?>
	<?php
		if ($event["Event"]["type"] == "commission" &&
            $event["Event"]["closed_sent"] === null &&
            strtotime($event["Event"]["reservation_end"]) <= time()) {
			echo $this->Html->buttonLink("Bearbeitungsabschlussmail verschicken", array("action" => "mail_closed", $event['Event']['id']));
		} ?>
    <?php endif ?>
	<?php
		if ($event["Event"]["review_sent"] === null && strtotime($event["Event"]["date"]) <= time()) {
			echo $this->Html->buttonLink("Abschlussmail verschicken", array("action" => "mail_review", $event['Event']['id']));
		} ?>
</p>
