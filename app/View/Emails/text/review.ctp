Sehr geehrte(r) Flohmarkt Verkäufer/in,

der Flohmarkt <?php echo $event["Event"]["name"]; ?> (vom <?php echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y") ?>) ist beendet.

Vielen Dank für Ihre Teilnahme als Verkäufer. Sie haben zu einer großartigen Spende an die Kindergärten in Königsbach beigetragen. Wir hoffen, dass es für Sie genau so ein tolles und erfolgreiches Ergebnis war, wie für uns.
<?php if ($event["Event"]["type"] == "commission"): ?>
Wir haben einige Auswertungen über die Verkäufe auf der folgenden Webseite für Sie zusammengestellt. Sie können dort auch sehen, ob Sie unter den Top 10 der Verkäufer gelandet sind:

<?php echo $this->Html->url("/events/view/".$event['Event']['id'], true) ?>
<?php endif ?>

Außerdem würden wir uns sehr freuen, wenn Sie uns Ihre persönlichen Erfahrungen mitteilen könnten. Sie haben unter dem folgenden Link die Möglichkeit, unseren Flohmarkt zu bewerten und Empfehlungen zu geben, wie wir unser System und den Flohmarkt in Zukunft verbessern können, um das Erlebnis für Verkäufer und Käufer noch schöner zu gestalten:

<?php echo $this->Html->url("/sellers/review/".$reservation['Seller']['token']."/".$event['Event']['id'], true) ?>


Wir hoffen, Sie auch beim nächsten Mal wieder als Verkäufer begrüßen zu dürfen.

Viele Grüße,
Ihr Flohmarkt-Team
