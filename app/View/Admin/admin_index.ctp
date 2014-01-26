<?php $this->set("title_for_layout", "Adminbereich") ?>
<p class="actions">
	<?php echo $this->Html->link("Termine", array("controller" => "events", "action" => "index")); ?>
	<?php echo $this->Html->link("Verkäufer", array("controller" => "sellers", "action" => "index")); ?>
	<?php echo $this->Html->link("Kategorien", array("controller" => "categories", "action" => "index")); ?>
	<?php echo $this->Html->link("Mails triggern", "/mails/worker"); ?>
	<?php echo $this->Html->link("DB Dump", array("action" => "dump")); ?>
</p>
<h3>Verkäufer</h3>
<p>
<ul>
	<li>gesamt: <?php echo $seller_count ?></li>
	<li>aktiviert: <?php echo $active_seller_count ?></li>
	<li>wartend: <?php echo $waiting_seller_count ?></li>
</ul>
</p>
<h3>Artikel</h3>
<p>
<ul>
	<li>gesamt: <?php echo $item_count ?></li>
	<li>von Reservierungen: <?php echo $item_count_for_reservations ?></li>
	<li>Etiketten: <?php echo $reserved_item_count ?></li>
</ul>
</p>
<h3>Mailqueue</h3>
<p>
<ul>
	<li>gesamt: <?php echo $sent_mails + $unsent_mails ?></li>
	<li>gesendet: <?php echo $sent_mails ?></li>
	<li>in Queue: <?php echo $unsent_mails ?></li>
	<li>zuletzt gesendete Mail: <?php echo $last_sent_mail ?></li>
</ul>
</p>
