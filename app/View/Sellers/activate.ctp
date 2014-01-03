<h2>Aktivierung der Registrierung erfolgreich</h2>
<p>Vielen Dank für die Bestätigung Ihrer Registrierung. Sie werden ab sofort über Neuigkeiten informiert.</p>
<?php if ($events): ?>
	Es gibt aktuell die folgenden Veranstaltungen, für die Sie einen Verkäuferplatz reservieren können. Klicken Sie bitte auf den Reservieren-Link neben der Veranstaltung, für die Sie einen Platz verbindlich reservieren möchten:</p>
	<ul>
	<?php foreach ($events as $event): ?>
		<li><strong><?php echo $event["Event"]["name"] ?></strong>
			(am <?php echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y") ?>
				von <?php echo $this->Time->format($event["Event"]["start_time"], "%H:%M") ?>
				bis <?php echo $this->Time->format($event["Event"]["end_time"], "%H:%M") ?> Uhr)
			- <?php echo $this->Html->link("Reservieren", array("action" => "reservation", $seller["Seller"]["token"], $event["Event"]["id"])); ?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif ?>
<p/>
<p><?php echo $this->Html->link("Zurück zur Hauptseite", "/") ?></p>
