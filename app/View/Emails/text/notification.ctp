Sehr geehrter Interessent/sehr geehrte Interessentin,

Wir freuen uns, Ihnen mitteilen zu können, dass ein oder mehrere Verkäuferplätze für den kommenden Flohmarkt frei geworden sind.

Flohmarkt: <?php echo $event["Event"]["name"]; ?>

Termin: am <?php
	echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y")
?> von <?php
	echo $this->Time->format($event["Event"]["start_time"], "%H:%M")
?> bis <?php
	echo $this->Time->format($event["Event"]["end_time"], "%H:%M")
?> Uhr

Sie können sich über den folgenden Link einen der freigewordenen Verkäuferplätze sichern:

<?php echo $this->Html->url("/sellers/reservation/".$seller['Seller']['token']."/".$event['Event']['id'], true) ?>


Bitte haben Sie Verständnis, dass zum Zeitpunkt, zu dem Sie den Link aufrufen und die Reservierung durchführen wollen, gegebenenfalls kein Platz mehr frei sein kann.

Mit erfolgreicher Reservierung wird Ihnen eine Reservierugnsnummer zugeteilt.
<?php if ($event["Event"]["type"] == "commission"): ?>
Sie können mit Erhalt Ihrer Reservierungssnummer die Etiketten für Ihre angebotenen Artikel erzeugen und ausdrucken.
Um Ihre angebotenen Artikel zu verwalten und die Etiketten zu erzeugen, rufen Sie bitte den folgenden Link auf:
<?php else: ?>
Ihren gesicherten Zugangsbereich erreichen Sie über den folgenden Link:
<?php endif ?>
<?php echo $this->Html->url("/sellers/login/".$seller["Seller"]["token"], true) ?>


Viele Grüße,
Ihr Flohmarkt-Team
