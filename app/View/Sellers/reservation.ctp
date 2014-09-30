<?php $this->set("title_for_layout", "Reservierung erfolgreich") ?>
<p>Herzlichen Glückwunsch! Ihre Reservierung war erfolgreich. Sie haben die Reservierungsnummer <strong><?php echo $number ?></strong>. Damit können Sie jetzt die Etiketten für Ihre angebotenen Artikel erzeugen und drucken.</p>
<p>Sie haben bis zum <?php echo $this->Time->format($event["Event"]["reservation_end"], "%A, %e. %B %Y") ?> um <?php echo $this->Time->format($event["Event"]["reservation_end"], "%H:%M") ?> Uhr Zeit, Ihre Artikel einzutragen.</p>
<p><?php echo $this->Html->buttonLink("Zur Hauptseite Ihres geschützten Bereichs", array("controller" => "sellers", "action" => "view")) ?></p>
