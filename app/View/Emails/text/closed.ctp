Sehr geehrte(r) Flohmarkt Verkäufer/in,

Die Vorbereitungen für den Flohmarkt sind abgeschlossen. Die Bearbeitung Ihrer Artikel ist damit nicht mehr möglich.

Flohmarkt: <?php echo $event["Event"]["name"]; ?>

Termin: am <?php
	echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y")
?> von <?php
	echo $this->Time->format($event["Event"]["start_time"], "%H:%M")
?> bis <?php
	echo $this->Time->format($event["Event"]["end_time"], "%H:%M")
?> Uhr

Sollten Sie die Etiketten für die von Ihnen angelegten Artikel noch nicht heruntergeladen und ausgedruckt haben, können Sie dies über den Aufruf des folgenden Links tun:

<?php echo $this->Html->url("/sellers/pdf/".$reservation['Seller']['token']."/".$event['Event']['id'], true) ?>


Viele Grüße,
Ihr Flohmarkt-Team
