Sehr geehrter Flohmarkt Interessent/sehr geehrte Interessentin,

Wir freuen uns, Ihnen mitteilen zu können, dass die Reservierung von Verkäuferplätzen für den kommenden Flohmarkt in Kürze startet.

Flohmarkt: <?php echo $event["Event"]["name"]; ?>

Termin: am <?php
	echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y")
?> von <?php
	echo $this->Time->format($event["Event"]["start_time"], "%H:%M")
?> bis <?php
	echo $this->Time->format($event["Event"]["end_time"], "%H:%M")
?> Uhr

Die Möglichkeit zur Reservierung wird am <?php
	echo $this->Time->format($event["Event"]["reservation_start"], "%A, %e. %B %Y")
?> um <?php echo $this->Time->format($event["Event"]["reservation_start"], "%H:%M") ?> Uhr freigeschaltet.

Sie können sich ab diesem Zeitpunkt über den folgenden Link einen Verkäuferplatz reservieren:

<?php echo $this->Html->url("/sellers/reservation/".$seller['Seller']['token']."/".$event['Event']['id'], true) ?>


Die Anzahl der Reservierungsplätze ist begrenzt auf <?php echo $event["Event"]["max_sellers"] ?>. Jeder Verkäufer darf maximal <?php echo $event["Event"]["max_items_per_seller"] ?> Artikel anbieten.

Mit erfolgreicher Reservierung wird Ihnen eine Reservierugnsnummer zugeteilt.
Sie können mit Erhalt Ihrer Reservierungssnummer die Etiketten für Ihre angebotenen Artikel erzeugen und ausdrucken.
Um Ihre angebotenen Artikel zu verwalten und die Etiketten zu erzeugen, rufen Sie bitte den folgenden Link auf:

<?php echo $this->Html->url("/sellers/login/".$seller["Seller"]["token"], true) ?>


Viele Grüße,
Ihr Flohmarkt-Team
