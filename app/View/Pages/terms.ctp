<?php $this->set("title_for_layout", "Teilnahmebedingungen") ?>
<p>Vor der Registrierung müssen Sie die Teilnahmebedingungen akzeptieren.</p>
<p><strong>In Kommission genommen werden</strong> gut erhaltene, gewaschene Baby- und Kinderbekleidung für die
kommende Jahreszeit bis Größe 176, Umstandsmode, Schuhe, Kinderbetten, Kinderwägen, Buggys, Autositze, Rutschautos, Kettcars, 
Fahrräder, Spielsachen etc. </p>
<h3>WICHTIG!</h3>
<p>Die Ware muss ...
	<ol>
		<li>zuvor in unserem Warensystem komplett eingetragen worden sein,</li>
		<li>einzeln mit dem entsprechenden Etikett ausgezeichnet sein. <strong>Der Barcode und die Zahl darunter muss vollständig lesbar und sauber sein. Es werden nur Etiketten akzeptiert, die mit unserem System erzeugt wurden.</strong></li>
		<li>in einem <strong>Karton/Wäschekorb</strong> angeliefert werden, der mit der <strong>Teilnehmernummer gut sichtbar</strong> gekennzeichnet ist. (2-teilige oder mehrteilige Kleidungsstücke bitte zusammennähen.)</li>
		<li>in einem <strong>einwandfreien und zeitgemäßen Zustand</strong> sein</li>
	</ol>
</p>
<p>Sollten Sie keine Möglichkeit zum Drucken haben, befestigen Sie bitte Papierschilder mit der Größe von min. 7x5cm an Ihren Artikeln und beschriften diese mit der Positionsnr. oder Artikelnummer. 
Sie bekommen bei der Annahme von uns Etikettenaufkleber um diese zu überkleben. (Wir behalten uns vor, für diesen Service 2,00 Euro zu berechnen)</p>
<p>Falsch ausgezeichnete Ware oder solche mit abgefallenen Etiketten kann 
von uns leider nicht verkauft werden. Wir legen Wert auf einwandfreie, 
zeitgemäße Ware und behalten uns vor, Teile auszusortieren.</p>
<p>Für die abgegebene Ware kann (bei Beschädigung und Diebstahl) <strong>keine 
Haftung</strong> übernommen werden. Für die Rückgabe von Kleiderbügeln kann 
keine Gewähr übernommen werden.</p>
<p>Es entfällt pro Teilnehmer eine <strong>Teilnahmegebühr</strong> von <strong>2,50 €</strong>.</p>
<p>Nur ein Teilnehmer je Haushalt. Mehrere Anmeldungen des gleiches Haushaltes sind nicht gestattet.</p>
<p>Es werden nur Preise akzeptiert, die auf 10 Cent gerundet sind.</p>
<p>Die Teilnehmer müssen die nicht verkaufte Ware, sowie den Erlös der 
verkauften Teile <strong>sofort kontrollieren</strong>.</p>
<p>Sollte Ihre nicht verkaufte Ware bis 18.30 Uhr am Verkaufstag <strong>nicht abgeholt</strong> 
sein, betrachten wir die Ware als <strong>Spende</strong>.</p>
<p>Als Unkostenbeitrag behalten wir 20% des Erlöses ein, der nach Abzug 
der Kosten den Kindergärten Regenbogen und Arche Noah zu gleichen Teilen gespendet wird.</p>
<?php
	echo $this->Form->create(null, array("type" => "get", "url" => "/sellers/register"));
	echo $this->Form->submit("Teilnahmebedingungen akzeptieren");
	echo $this->Form->end();
?>