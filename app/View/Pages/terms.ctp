<h2>Teilnahmebedingungen</h2>
<p>Vor der Registrierung müssen Sie die Teilnahmebedingungen akzeptieren. Diese können Sie
<?php echo $this->Html->link("hier als PDF-Datei herunterladen", "/files/teilnahmebedingungen.pdf"); ?>.</p>
<p><strong>In Kommission genommen werden</strong> gut erhaltene, gewaschene Baby- und Kinderbekleidung für die
kommende Jahreszeit bis Größe 176, Umstandsmode, Schuhe, Kinderbetten, Kinderwägen, Buggys, Autositze, Rutschautos, Kettcars, 
Fahrräder, Spielsachen etc. <strong>Jacken und Kleider bitte mit Kleiderbügeln abgeben.</strong></p>
<h3>WICHTIG!</h3>
<p>Die Ware muss ...
	<ol>
		<li>einzeln mit dem beiliegenden Etikett ausgezeichnet sein <strong>(Bitte nicht mit der Nähmaschine annähen und nicht laminieren !)</strong>,</li>
		<li>in beiliegender Liste <strong>gut lesbar</strong> eingetragen sein,</li>
		<li>in einem <strong>Karton/Wäschekorb</strong> angeliefert werden, der mit der <strong>Teilnehmernummer gut sichtbar</strong> gekennzeichnet ist. (2-teilige oder mehrteilige Kleidungsstücke bitte zusammennähen.)</li>
		<li>Etiketten sind korrektund gut lesbar auszufüllen. (bei Büchern + Spielen die Etiketten nicht an allen 4 Ecken ankleben. Etiketten nur oben ankleben !)</li>
		<li>in einem <strong>einwandfreien und zeitgemäßen Zustand</strong> sein</li>
	</ol>
</p>
<p>Falsch ausgezeichnete Ware oder solche mit abgefallenen Etiketten kann 
von uns leider nicht verkauft werden. Wir legen Wert auf einwandfreie, 
zeitgemäße Ware und behalten uns vor, Teile auszusortieren.</p>
<p>Für die abgegebene Ware kann (bei Beschädigung und Diebstahl) <strong>keine 
Haftung</strong> übernommen werden. Für die Rückgabe von Kleiderbügeln kann 
keine Gewähr übernommen werden.</p>
<p>Es entfällt pro Liste eine <strong>Teilnahmegebühr</strong> von <strong>2,50 €</strong>.</p>
<p>Wir behalten uns vor, bei der Abrechnung die Auszahlungsbeträge auf 
ganze 10 Cent-Beträge abzurunden (z.B. bei 25,76€ werden 25,70€ 
ausbezahlt).</p>
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