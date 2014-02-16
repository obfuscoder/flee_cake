<?php $this->set("title_for_layout", "Bewertung") ?>
<p>Vielen Dank, dass Sie als Verkäufer an unserem Flohmarkt teilgenommen haben. Wir hoffen, dass Ihnen unser neues System gefallen hat.</p>
<p>Um Ihnen in Zukunft die Arbeit noch weiter zu erleichtern, sind wir an Ihrem persönlichen Urteil interessiert. Bitte nehmen Sie sich ein paar Minuten Zeit und helfen uns, das System für Sie noch mehr zu verbessern, indem Sie uns bewerten und uns mitteilen, was Ihnen gut gefallen hat, aber besonders, was Sie persönlich für verbesserungswürdig halten.</p>
<p>Bewerten Sie bitte die folgenden Punkte entsprechend dem <strong>Schulnotensystem</strong> (1=sehr gut bis 6=ungenügend). Wenn Sie einen Punkt nicht beantworten wollen/können, lassen Sie ihn einfach leer.</p>
<?php echo $this->Form->create('Review');
	$options = array(1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "");
	$attributes = array(
				'value' => false,
			    'label' => false,
			    'between' => '</td><td>',
			    'separator' => '</td><td>',
			    'legend' => false,
			); ?>
<table>
	<thead>
		<tr>
			<th>Wie zufrieden waren Sie mit ...</th>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>... der Anmeldung / Registrierung?</td>
			<td><?php echo $this->Form->radio('registration', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... der Verwaltung der Artikel?</td>
			<td><?php echo $this->Form->radio('items', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... dem Erzeugen und Ausdrucken der Etiketten?</td>
			<td><?php echo $this->Form->radio('print', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... dem Verfahren zur Vergabe der Verkäuferplätze?</td>
			<td><?php echo $this->Form->radio('reservation', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... den Informationen per Mail?</td>
			<td><?php echo $this->Form->radio('mailing', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... den Inhalten und Erklärungen auf der Webseite?</td>
			<td><?php echo $this->Form->radio('content', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... dem Aussehen der Webseite?</td>
			<td><?php echo $this->Form->radio('design', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... unserer Unterstützung bei Problemen?</td>
			<td><?php echo $this->Form->radio('support', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... der Abwicklung bei Annahme und Rückgabe der Artikel?</td>
			<td><?php echo $this->Form->radio('handover', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... der Abrechnung?</td>
			<td><?php echo $this->Form->radio('payoff', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... dem Verkauf selbst?</td>
			<td><?php echo $this->Form->radio('sale', $options, $attributes); ?><td>
		</tr>
		<tr>
			<td>... mit der Organisation?</td>
			<td><?php echo $this->Form->radio('organization', $options, $attributes); ?><td>
		</tr>
		<tr>
			<th colspan="7">Bitte geben Sie noch eine Gesamtnote über die gesamte Flohmarktveranstaltung</th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><?php echo $this->Form->radio('total', $options, $attributes); ?></td>
		</tr>
	</tbody>
</table>
<table><tr><th colspan="5">Wie sind Sie auf uns aufmerksam geworden?</th></tr><tr><td><?php echo $this->Form->radio('source', array("newspaper" => "Zeitungsanzeige", "poster" => "Plakat", "internet" => "Internet", "friends" => "Bekannte/Familie", "other" => "Sonstiges"), $attributes); ?></td></tr></table>
<table><tr><th colspan="2">Würden Sie unser Abrechnungssystem weiterempfehlen?</th></tr><tr><td><?php echo $this->Form->radio('recommend', array('yes' => "ja", 'no' => "nein"), $attributes); ?></td></tr></table>
<table><tr><th>Welche Dinge haben Ihnen nicht gefallen bzw. was sollten wir Ihrer Meinung nach verbessern?</th></tr><tr><td><?php echo $this->Form->input('to_improve', array('type' => 'textarea', 'label' => false)); ?></td></tr></table>
<?php echo $this->Form->submit("Bewertung abschließen"); ?>
