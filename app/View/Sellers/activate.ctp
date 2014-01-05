<?php $this->set("title_for_layout", "Reservierung") ?>
<p>Ihre Registrierung war erfolgreich. Sie werden ab sofort über Neuigkeiten informiert.</p>
<?php if ($reservable_events): ?>
<p>Sie können sich bereits für die folgenden Flohmärkte einen Verkäuferplatz reservieren:<p>
	<ul>
	<?php foreach ($reservable_events as $event): ?>
		<li><strong><?php echo $event["Event"]["name"] ?></strong>
			(am <?php echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y") ?>
				von <?php echo $this->Time->format($event["Event"]["start_time"], "%H:%M") ?>
				bis <?php echo $this->Time->format($event["Event"]["end_time"], "%H:%M") ?> Uhr):
			<?php
				echo $this->Form->create(null, array("type" => "get",
					"url" => "/sellers/reservation/".$seller['Seller']['token']."/".$event['Event']['id']));
				echo $this->Form->submit("Reservieren");
				echo $this->Form->end();
			?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>Momentan ist noch keine Reservierung möglich. Die folgenden Termine sind bereits bekannt:</p>
	<ul>
	<?php foreach ($future_events as $event): ?>
		<li><strong><?php echo $event["Event"]["name"] ?></strong>
			(am <?php echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y") ?>):
			Reservierung ab <?php echo $this->Time->format($event["Event"]["reservation_start"], "%A, %e. %B %Y um %H:%M Uhr") ?> möglich.
		</li>
	<?php endforeach; ?>
	</ul>
	<p/>
	<p>Damit alle die gleichen Chancen auf einen Platz haben, erfolgt die
	Reservierung zu den oben genanten Zeitpunkten. Sie werden 1-4 Tage vor
	Reservierungsstart nochmals per Mail Informiert. Ihre Artikel können Sie
	bereits <?php echo $this->Html->link("hier", "/sellers/login/" . $seller["Seller"]["token"]) ?> eingeben.</p>
<?php endif ?>
<p/>
<p><?php echo $this->Html->link("Zurück zur Hauptseite", "/") ?></p>
