<?php $this->set("title_for_layout", "") ?>
<p>
	<img src="img/kitaregenbogen.jpg"/>
	<img src="img/archenoahkita.jpg"/>
</p>
<p>
	Auf diesen Seiten können Sie sich für unsere kommenden Flohmärkte als Interessent zum Verkauf von Kommissionsware registrieren. Sie werden dann zeitnah per Mail über den weiteren Ablauf informiert.
</p>
<p>Die Anzahl der Verkäufer ist  begrenzt. Die Platzreservierung findet ab einem bestimmten Datum vor Beginn des Flohmarkts statt und wird hier auf den Webseiten sowie per eMail an alle registrierten Interessenten rechtzeitig angekündigt. Nur registrierte Verkäufer können eine Platzreservierung online durchführen. Genaue Informationen darüber erhalten Sie mit der Registrierung.</p>

<?php
	echo $this->Form->create(null, array("type" => "get", "url" => "/pages/terms"));
	echo $this->Form->submit("Zur Registrierung");
	echo $this->Form->end();
?>
<p><?php echo $this->Html->link("Bereits registriert?", "/sellers/already_registered") ?></p>

<h3>Kommende Flohmärkte</h3>
<ul>
<?php foreach ($events as $event): ?>
<li>
	<?php echo $this->Html->image("icons/spring.jpg"); ?>
	<h4><?php echo $event["Event"]["name"] ?></h4>
	<p><?php echo $event["Event"]["date_string"] ?><br/>
	<?php if ($event["Event"]["details"]): ?>((<?php echo $event["Event"]["details"] ?>)<br/><?php endif ?>
<?php if ($event["Event"]["date_confirmed"]): ?>
	Reservierungsstart: <?php echo $event["Event"]["reservation_start_string"] ?><br/>
	Plätze: <?php echo $event["Event"]["max_sellers"] ?><br/>
	Warenannahme: <?php echo $event["Event"]["item_handover_date_string"] ?><br/>
	Warenrückgabe: <?php echo $event["Event"]["item_pickup_date_string"] ?>
<?php endif ?>
</p>
</li>
<?php endforeach; ?>
</ul>
<p>Hier noch ein paar Impressionen der Festhalle</p>
<?php
	echo $this->Html->image("flohmarkt.jpg", array("width" => 300, "style" => "margin: 5px"));
	echo $this->Html->image("flohmarkt2.jpg", array("width" => 300, "style" => "margin: 5px"));
	echo $this->Html->image("kinderbetreuung.jpg", array("width" => 300, "style" => "margin: 5px"));
?>

