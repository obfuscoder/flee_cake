<?php $this->set("title_for_layout", "Hauptseite") ?>
<p>
	<img src="img/kitaregenbogen.jpg"/>
	<img src="img/archenoahkita.jpg"/>
</p>
<p>
	Auf diesen Seiten können Sie sich für unseren kommenden (<strong><?php echo $event_date ?></strong> stattfindenden) Flohmarkt als Interessent zum Verkauf von Kommissionsware registrieren. Sie werden dann zeitnah per Mail über den weiteren Ablauf informiert.
</p>
<p>Die Anzahl der Verkäufer ist begrenzt. Die Platzreservierung wird <strong><?php echo $reservation_date ?></strong> freigeschaltet. Dazu werden alle registrierte Interessenten kurz zuvor eine gesonderte Benachrichtigung mit Detailinformationen per Mail erhalten.</p>

<?php
	echo $this->Form->create(null, array("type" => "get", "url" => "/pages/terms"));
	echo $this->Form->submit("Zur Registrierung");
	echo $this->Form->end();
?>
<p><?php echo $this->Html->link("Bereits registriert?", "/sellers/already_registered") ?></p>
