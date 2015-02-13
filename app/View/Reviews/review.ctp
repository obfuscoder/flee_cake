<?php $this->set("title_for_layout", "Bewertung") ?>
<p>Vielen Dank, dass Sie als Verkäufer an unserem Flohmarkt teilgenommen haben. Wir hoffen, dass Ihnen unser neues System gefallen hat.</p>
<p>Um Ihnen in Zukunft die Arbeit noch weiter zu erleichtern, sind wir an Ihrem persönlichen Urteil interessiert. Bitte nehmen Sie sich ein paar Minuten Zeit und helfen uns, das System für Sie noch mehr zu verbessern, indem Sie uns bewerten und uns mitteilen, was Ihnen gut gefallen hat, aber besonders, was Sie persönlich für verbesserungswürdig halten.</p>
<p>Bewerten Sie bitte die folgenden Punkte entsprechend dem <strong>Schulnotensystem</strong> (1=sehr gut bis 6=ungenügend). Wenn Sie einen Punkt nicht beantworten wollen/können, lassen Sie ihn einfach leer.</p>
<?php echo $this->Form->create('Review');
    $options = array();
    for($i=1; $i<=6; $i++) {
        $options[$i] = $i;
    }
	$attributes = array(
				'value' => null,
			    'label' => false,
			    'between' => '</td><td>',
			    'separator' => '</td><td>',
			    'legend' => false,
			); ?>
<table class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th>Wie zufrieden waren Sie mit ...</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$questions = array(
			"registration" => "der Anmeldung / Registrierung",
			"items" => "der Verwaltung der Artikel",
			"print" => "dem Erzeugen und Ausdrucken der Etiketten",
			"reservation" => "dem Verfahren zur Vergabe der Verkäuferplätze",
			"mailing" => "den Informationen per Mail",
			"content" => "den Inhalten und Erklärungen auf der Webseite",
			"design" => "dem Aussehen der Webseite",
			"support" => "unserer Unterstützung bei Problemen",
			"handover" => "der Abwicklung bei Annahme und Rückgabe der Artikel",
			"payoff" => "der Abrechnung",
			"sale" => "dem Verkauf selbst",
			"organization" => "mit der Organisation"
			);
			foreach($questions as $type => $question): ?>
			<tr>
				<td>... <?php echo $question ?>?</td>
				<td><?php echo $this->Form->radio($type, $options); ?></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<th>Bitte geben Sie noch eine Gesamtnote</th>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><?php echo $this->Form->radio('total', $options, $attributes); ?></td>
		</tr>
	</tbody>
</table>
<table class="table table-condensed table-hover table-striped">
	<tr><th colspan="5">Wie sind Sie auf uns aufmerksam geworden?</th></tr>
	<tr><td><?php echo $this->Form->radio('source', array(
		"newspaper" => "Zeitungsanzeige",
		"poster" => "Plakat",
		"internet" => "Internet",
		"friends" => "Bekannte/Familie",
		"other" => "Sonstiges"
		), $attributes); ?></td></tr>
</table>
<table class="table table-condensed table-hover table-striped">
	<tr><th colspan="2">Würden Sie unser Abrechnungssystem weiterempfehlen?</th></tr>
	<tr><td><?php echo $this->Form->radio('recommend', array(true => "ja", false => "nein"), $attributes); ?></td></tr>
</table>
<table class="table table-condensed table-hover table-striped">
	<tr><th>Welche Dinge haben Ihnen nicht gefallen bzw. was sollten wir Ihrer Meinung nach verbessern?</th></tr>
	<tr><td><?php echo $this->Form->input('to_improve', array('type' => 'textarea', 'label' => false)); ?></td></tr>
</table>
<?php echo $this->Form->submit("Bewertung abschließen"); ?>
