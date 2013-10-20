<h3>Reservierung erfolgreich</h3>
<p>Herzlichen Glückwunsch! Ihre Reservierung war erfolgreich. Sie haben die Reservierungsnummer <strong><?php echo $number ?></strong>. Damit können Sie jetzt die Etiketten für Ihre angebotenen Artikel erzeugen und drucken.</p>
<p>Sie haben bis zum <?php echo $this->Time->format($event["Event"]["reservation_end"], "%A, %e. %B %Y") ?> um <?php echo $this->Time->format($event["Event"]["reservation_end"], "%H:%M") ?> Uhr Zeit, Ihre Artikel einzutragen.</p>
<p class="actions"><?php echo $this->Html->link("Artikel verwalten und Etiketten erzeugen", array("controller" => "items", $seller["Seller"]["id"])) ?></p>
