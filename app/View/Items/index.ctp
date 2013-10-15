<h2><?php echo __("Items") ?></h2>
<p>Hier können Sie Ihre Artikel verwalten.</p>
<p class="actions"><?php if (count($items) < 50) echo $this->Html->link("Artikel hinzufügen", array("controller" => "items", "action" => "create", $seller_id)); ?></p>
<table>
	<tr>
		<th>Nummer</th>
		<th>Beschreibung</th>
		<th>Kategorie</th>
		<th>Größe</th>
		<th>Preis</th>
		<th>Aktionen</th>
	</tr>
	<?php for ($i=0; $i<count($items); $i++): ?>
	<tr>
		<?php $item = $items[$i]; ?>
		<td><?php echo $i+1 ?></td>
		<td><?php echo $item["Item"]["description"]; ?></td>
		<td><?php echo $item["Category"]["name"]; ?></td>
		<td><?php echo $item["Item"]["size"]; ?></td>
		<td><?php echo $this->Number->currency($item["Item"]["price"], "EUR"); ?></td>
		<td class="actions"><?php echo $this->Html->link("Bearbeiten", array("controller" => "items", "action" => "update", $item["Item"]['id'])); ?>
			<?php echo $this->Form->postLink("Löschen", array("controller" => "items", "action" => "delete", $item["Item"]['id']), array("confirm" => "Sind Sie sicher, dass Sie diesen Artikel löschen wollen?")); ?></td>
	</tr>
	<?php endfor; ?>
	<?php unset($item); ?>
</table>
<?php if (count($items) > 0): ?>
<p>Sobald Sie alle Artikel angelegt und Sie einen Verkäuferplatz erhalten haben, können Sie sich die Etiketten für die Artikel erzeugen.
<p class="actions"><?php echo $this->Html->link("Etiketten erzeugen und herunterladen", array("controller" => "items", "action" => "pdf", $seller_id), array(), "Sobald Sie die Etiketten erzeugen, werden alle bis jetzt eingegebenen Artikel gesperrt. Sie können diese Artikel nicht mehr bearbeiten. Sie können jedoch danach noch weitere Artikel hinzufügen. Wollen Sie die Etiketten erzeugen lassen und damit die aktuellen Artikel sperren?"); ?></p>
 <p><small>Die Etiketten werden als PDF-Dokument generiert. Zum Anzeigen und Ausdrucken von PDF-Dateien benötigen Sie ein entsprechendes Programm. Falls noch nicht vorhanden, installieren Sie sich bitte ein dazu passendes Programm. Wir empfehlen den <a href="http://get.adobe.com/reader/">Adobe Acrobat Reader</a> oder den <a href="http://www.foxitsoftware.com/Secure_PDF_Reader/">FoxIt Reader</a>.</small></p>
<?php endif; ?>