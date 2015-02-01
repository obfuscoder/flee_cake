<?php $this->set("title_for_layout", "") ?>
<?php echo Configure::read('Brand.home.intro_html') ?>
<p>
	Auf diesen Seiten können Sie sich für unsere kommenden Flohmärkte als Verkäufer registrieren. Sie werden dann zeitnah per Mail über den weiteren Ablauf informiert.
</p>
<p>
    Die Anzahl der Verkäufer ist in der Regel begrenzt. Die Reservierung findet ab einem bestimmten Datum vor Beginn des Flohmarkts statt und wird hier auf den Webseiten sowie per eMail an alle registrierten Interessenten rechtzeitig angekündigt. Nur registrierte Verkäufer können eine Reservierung online durchführen. Genaue Informationen darüber erhalten Sie mit der Registrierung.
</p>

<?php
	echo $this->Form->create(null, array("type" => "get", "url" => "/pages/terms"));
	echo $this->Form->hidden("accept");
	echo $this->Form->end("Zur Registrierung");
?>
<p/>
<p>Sie sind <strong>bereits registriert</strong>, finden aber nicht mehr die eMail mit den Zugangsinformationen zu Ihren privaten Bereich? Dann klicken Sie bitte <?php echo $this->Html->link("auf diesen Link.", "/sellers/already_registered") ?></p>

<h3>Kommende Flohmärkte</h3>
<?php if ($events): ?>
<ul class="thumbs">
<?php foreach ($events as $event): ?>
<li>
	<?php echo $this->Html->image("icons/spring.jpg"); ?>
	<h4><?php echo $event["Event"]["name"] ?></h4>
	<p><?php echo $event["Event"]["date_string"] ?><br/>
	<?php if ($event["Event"]["details"]): ?><?php echo $event["Event"]["details"] ?><br/><?php endif ?>
<?php if ($event["Event"]["date_confirmed"]): ?>
	Reservierungsstart: <?php echo $event["Event"]["reservation_start_string"] ?><br/>
	Plätze: <?php echo $event["Event"]["max_sellers"] ?>
    <?php if ($event["Event"]["type"] == "commission"): ?><br/>
	Warenannahme: <?php echo $event["Event"]["item_handover_date_string"] ?><br/>
	Warenrückgabe: <?php echo $event["Event"]["item_pickup_date_string"] ?>
    <?php endif ?>
<?php endif ?>
</p>
</li>
<?php endforeach; ?>
</ul>
<?php else: ?>
	<p>Aktuell sind keine Flohmärkte geplant.</p>
<?php endif ?>
<?php echo Configure::read('Brand.home.outro_html') ?>
