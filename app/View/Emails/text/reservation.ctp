Sehr geehrter Flohmarkt Teilnehmer/sehr geehrte Teilnehmerin,

Sie haben erfolgreich eine Reservierung für den folgenden Flohmarkt erhalten:

Flohmarkt: <?php echo $reservation["Event"]["name"]; ?>

Termin: am <?php
	echo $this->Time->format($reservation["Event"]["date"], "%A, %e. %B %Y")
?> von <?php
	echo $this->Time->format($reservation["Event"]["start_time"], "%H:%M")
?> bis <?php
	echo $this->Time->format($reservation["Event"]["end_time"], "%H:%M")
?> Uhr

Ihre Reservierungsnummer ist <?php echo $reservation["Reservation"]["number"] ?>.
<?php if ($reservation["Event"]["type"] == "commission"): ?>
Sie können ab sofort Etiketten für Ihre Artikel erzeugen und drucken über den Zugang zu Ihrem geschützten Bereich.

Bitte beachten Sie, dass sämtliche Artikel bis zum <?php echo $this->Time->format($reservation["Event"]["reservation_end"], "%A, %e. %B %Y um %H:%M Uhr") ?> eingegeben und die Etiketten dafür erzeugt sein müssen.
<?php endif ?>
Ihren geschützten Bereich erreichen Sie über folgenden Link:

<?php echo $this->Html->url("/sellers/login/".$reservation['Seller']['token'], true) ?>


Sollten Sie doch nicht teilnehmen können, melden Sie sich bitte unter
dem oben genannten Link ab, damit andere Verkäufer nachrücken können.

Viele Grüße,
Ihr Flohmarkt-Team
