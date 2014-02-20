<?php $this->set("title_for_layout", "Bewertungen") ?>
<p>
Anzahl: <?php echo $review_count ?>
</p>
<p>
<dl>
<?php foreach($reviews as $k=>$v): ?>
	<dt><?php echo $k ?></dt><dd><?php echo sprintf("%.1f", $v) ?> </dd>
<?php endforeach ?>
</dl></p>
<h3>Bemerkungen</h3>
<p><ul>
	<?php foreach ($comments as $comment): ?>
	<li><?php echo $comment ?></li>
	<?php endforeach ?>
</ul></p>
<p><?php echo $this->Html->link("Hauptseite", array("controller" => "admin", "action" => "index")); ?></p>
