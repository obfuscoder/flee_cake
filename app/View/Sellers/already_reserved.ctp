<?php $this->set("title_for_layout", "Reservierung bereits erfolgt") ?>
<p>Sie haben bereits für diesen Termin eine Reservierung <?php echo $this->Time->timeAgoInWords($reservation["created"], array('format' => 'd.m.Y')) ?> erhalten. Ihre Reservierungsnummer ist <strong><?php echo $reservation["number"] ?></strong>.</p>
<p>Sie haben bis zum <?php echo $this->Time->format($event["Event"]["reservation_end"], "%A, %e. %B %Y") ?> um <?php echo $this->Time->format($event["Event"]["reservation_end"], "%H:%M") ?> Uhr Zeit, Ihre Artikel einzutragen.</p>
<p class="actions"><?php echo $this->Html->link("Artikel verwalten und Etiketten erzeugen", array("controller" => "items")) ?></p>
