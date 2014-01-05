<?php $this->set("title_for_layout", "Verkäuferdetails") ?>
<p><strong><?php echo $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] ?></strong><br/>
<?php echo $seller["Seller"]["street"] ?><br/>
<?php echo $seller["Seller"]["zip_code"] . " " . $seller["Seller"]["city"] ?></br></p>
<p>Tel.: <?php echo $seller["Seller"]["phone"] ?><br/>
Mail: <a href="mailto:<?php echo $seller["Seller"]["email"] ?>"><?php echo $seller["Seller"]["email"] ?></a></p>
<p>Registriert: <?php echo $this->Time->timeAgoInWords($seller["Seller"]["created"], array('format' => 'd.m.Y')) ?></p>
<h3>Reservierungen</h3>
<p><ul>
	<?php foreach ($reservations as $reservation): ?>
	<li><?php echo $this->Html->link(
			$reservation["Event"]["name"],
			array("controller" => "events", "action" => "view",
			$reservation["Event"]["id"]))
		?> - Verkäufernummer <strong><?php echo $reservation["Reservation"]["number"] ?></strong></li>
	<?php endforeach; ?>
</ul></p>
<h3>Artikel</h3>
<p><ul>
	<?php foreach ($seller["Item"] as $item): ?>
	<li><?php echo $item["description"] . " - " . $this->Number->currency($item["price"], "EUR") ?></li>
	<?php endforeach; ?>
</ul></p>

<h3>Aktionen</h3>
<p class="actions">
	<?php echo $this->Html->link("Bearbeiten", array("action" => "edit", $seller["Seller"]["id"])); ?>
	<?php echo $this->Html->link("Artikel auflisten", array("controller" => "items", "action" => "index", $seller["Seller"]["id"])); ?>
</p>