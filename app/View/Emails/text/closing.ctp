Sehr geehrte(r) Flohmarkt Verkäufer/in,

Die Vorbereitungen für den Flohmarkt sind bald abgeschlossen.
Denken Sie bitte daran, Ihre Artikel bis zum <?php echo $this->Time->format($event["Event"]["reservation_end"], "%A, %e. %B %Y um %H:%M Uhr") ?>
komplett einzugeben und die Etiketten dafür zu erzeugen. Danach werden die Etiketten nicht mehr änderbar sein.

Flohmarkt: <?php echo $event["Event"]["name"]; ?>

Termin: am <?php
	echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y")
?> von <?php
	echo $this->Time->format($event["Event"]["start_time"], "%H:%M")
?> bis <?php
	echo $this->Time->format($event["Event"]["end_time"], "%H:%M")
?> Uhr

Sie können über den folgenden Link die Bearbeitung Ihrer Artikel, sowie das Erzeugen und Drucken der Etiketten aufrufen:

<?php echo $this->Html->url("/sellers/login/".$reservation["Seller"]["token"], true) ?>


Viele Grüße,
Ihr Flohmarkt-Team
