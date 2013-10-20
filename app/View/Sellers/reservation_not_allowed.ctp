<h3>Reservierung nicht möglich</h3>
<?php if (strtotime($event["Event"]["reservation_start"]) > time()): ?>
	<p>Die Reservierung ist nocht nicht freigeschaltet. Bitte haben Sie Verständnis dafür, dass wir allen Interessenten die gleiche Chance geben wollen, indem wir alle vorab per Mail über den Reservierungsbeginn informieren, und jeder die Zeit hat, sich auf diesen Termin vorzubereiten.</p>
	Sie können erst ab <?php
		echo $this->Time->format($event["Event"]["reservation_start"], "%A, %e. %B %Y")
	?> um <?php echo $this->Time->format($event["Event"]["reservation_start"], "%H:%M") ?> Uhr die Reservierung durchführen.</p>
<?php endif;
	if (strtotime($event["Event"]["reservation_end"]) < time()): ?>
	<p>Die Reservierung ist leider nicht mehr möglich. Der Veranstaltungstermin steht kurz bevor. Wir benötigen diese Vorlaufzeit, um den Flohmarkt zu organisieren.</p>	
<?php endif; ?>
