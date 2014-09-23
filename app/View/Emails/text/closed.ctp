Sehr geehrte(r) Flohmarkt Verkäufer/in,

Die Vorbereitungen für den Flohmarkt sind abgeschlossen. Die Bearbeitung Ihrer Artikel ist damit nicht mehr möglich. Für alle noch in Bearbeitung befindlichen Artikel wurden ebenfalls Etiketten erzeugt.

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


Geben Sie bitte Ihre zu verkaufenden Artikel am <?php
    echo $this->Time->format($event["Event"]["item_handover_date"], "%A, %e. %B %Y")
?> zwischen <?php
    echo $this->Time->format($event["Event"]["item_handover_start_time"], "%H:%M")
?> und <?php
    echo $this->Time->format($event["Event"]["item_handover_end_time"], "%H:%M")
?> Uhr bei uns ab.

Der Abholzeitraum ist am <?php
    echo $this->Time->format($event["Event"]["item_pickup_date"], "%A, %e. %B %Y")
?> zwischen <?php
    echo $this->Time->format($event["Event"]["item_pickup_start_time"], "%H:%M")
?> und <?php
    echo $this->Time->format($event["Event"]["item_pickup_end_time"], "%H:%M")
?> Uhr.

Viele Grüße,
Ihr Flohmarkt-Team
