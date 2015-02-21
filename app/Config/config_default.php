<?php
$config = array (
    'debug' => 2,

    'code' => array('prefix' => ''),
    'Security' => array (
        'salt' => 'V2d0kijxStO3w6xaAm73GoUG1hSMCDNGttg15CwukaXDBzIaWpKXoGtiX6njomz6',
        'cipherSeed' => '598391485038656422199915352281',
    ),
    'Database' => array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'database' => 'floh',
        'login' => 'root',
        'password' => 'root',
        'prefix' => '',
        'encoding' => 'utf8',
    ),
    'Brand' => array(
        'name' => 'Flohmarkt Königsbach',
        'mail_from' => 'info@flohmarkt-koenigsbach.de',
        'contact_mail' => 'hilfe@flohmarkt-koenigsbach.de',
        'privacy_mail' => 'privacy@flohmarkt-koenigsbach.de',
        'imprint' => array(
            'address' => array('Anne Lehmann', 'Am Schlossgarten 14', '75203 Königsbach'),
            'contact' => array('Telefon: +49 1523 378 9602', 'eMail: imprint@flohmarkt-koenigsbach.de')
        ),
        'home' => array(
            'intro_html' => '<p><img src="/img/kitaregenbogen.jpg"/><img src="/img/archenoahkita.jpg"</p>',
            'outro_html' => <<<EOT
                            <p><small>Hier noch ein paar Impressionen unseres Flohmarkts in der Festhalle Königsbach</small></p>
	                        <img src="/img/flohmarkt.jpg" width="300" style="margin: 5px"/>
                            <img src="/img/flohmarkt2.jpg" width="300" style="margin: 5px"/>
                            <img src="/img/kinderbetreuung.jpg" width="300" style="margin: 5px"/>
EOT
        ),
        'terms' => <<<EOT
<p>Vor der Registrierung müssen Sie die Teilnahmebedingungen akzeptieren.</p>
<p><strong>In Kommission genommen werden</strong> gut erhaltene, gewaschene Baby- und Kinderbekleidung für die
kommende Jahreszeit bis Größe 176, Umstandsmode, Schuhe, Kinderbetten, Kinderwägen, Buggys, Autositze, Rutschautos, Kettcars,
Fahrräder, Spielsachen etc. </p>
<h3>WICHTIG!</h3>
<p>Die Ware muss ...
	<ol>
		<li>zuvor in unserem Warensystem komplett eingetragen worden sein,</li>
		<li>einzeln mit dem entsprechenden Etikett ausgezeichnet sein. <strong>Der Barcode und die Zahl darunter muss vollständig lesbar und sauber sein. Es werden nur Etiketten akzeptiert, die mit unserem System erzeugt wurden.</strong></li>
		<li>in einem <strong>Karton/Wäschekorb</strong> angeliefert werden, der mit der <strong>Teilnehmernummer gut sichtbar</strong> gekennzeichnet ist. (mehrteilige Kleidungsstücke bitte zusammennähen.)</li>
		<li>in einem <strong>einwandfreien und zeitgemäßen Zustand</strong> sein</li>
	</ol>
</p>
<p>Falsch ausgezeichnete Ware oder solche mit abgefallenen Etiketten kann
von uns leider nicht verkauft werden. Wir legen Wert auf einwandfreie,
zeitgemäße Ware und behalten uns vor, Teile auszusortieren.</p>
<p>Für die abgegebene Ware kann (bei Beschädigung und Diebstahl) <strong>keine
Haftung</strong> übernommen werden. Für die Rückgabe von Kleiderbügeln kann
keine Gewähr übernommen werden.</p>
<p>Es entfällt pro Teilnehmer eine <strong>Teilnahmegebühr</strong> von <strong>2,50 €</strong>.</p>
<p><strong>Wir runden alle Verkäuferauszahlungsbeträge ab</strong> auf volle 10Cent. D.h. aus 10,88Euro wird 10,80Euro.</p>
<p>Nur ein Teilnehmer je Haushalt. Mehrere Anmeldungen des gleichen Haushaltes sind nicht gestattet. Wir behalten uns das Recht vor, Mehrfachreservierungen aus dem gleichen Haushalt wieder freizugeben.</p>
<p>Es werden nur Preise akzeptiert, die auf 10 Cent gerundet sind.</p>
<p>Die Teilnehmer müssen die nicht verkaufte Ware, sowie den Erlös der
verkauften Teile <strong>sofort kontrollieren</strong>.</p>
<p>Sollte Ihre nicht verkaufte Ware bis zum Ende des für den Flohmarkt festgelegten Abholzeitraums <strong>nicht abgeholt</strong>
sein, betrachten wir die Ware als <strong>Spende</strong>.</p>

<h3>Drucken der Etiketten</h3>
<p>Wir arbeiten beim Verkauf mit Scannern und akzeptieren daher nur Waren mit unseren Etiketten, welche Sie nach Artikeleingabe erzeugen und drucken.</p>
<p>Sollten Sie keine Möglichkeit zum Drucken haben, befestigen Sie bitte Papierschilder mit der Größe von min. 7x5cm an Ihren Artikeln und beschriften diese mit der Positionsnr. oder Artikelnummer.
Sie bekommen bei der Annahme von uns Etikettenaufkleber um diese zu überkleben. (Wir behalten uns vor, für diesen Service 2,00 Euro zu berechnen)</p>
<p>Handschriftliche Änderungen auf den Etiketten werden nicht akzeptiert. Das System kennt nur die Werte, welche online eingegeben wurden.</p>
<p>Bitte verwenden Sie für den Druck <u>kein rotes</u> oder sehr dunkles Papier</p>
<p>Die Etiketten dürfen laminiert oder geklebt werden (sofern dies nicht die Ware beschädigt)</p>

<h3>Verkaufserlös</h3>
<p>Als Unkostenbeitrag behalten wir 20% des Erlöses ein, der nach Abzug
der Kosten den Kindergärten Regenbogen und Arche Noah zu gleichen Teilen gespendet wird.</p>
EOT
    )
);