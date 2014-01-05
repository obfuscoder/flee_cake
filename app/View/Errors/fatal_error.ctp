<?php $this->set("title_for_layout", "Fehler") ?>
<?php echo $this->Html->image("error-kitten.jpg"); ?>
<p>Es ist ein unvorhergesehener Fehler aufgetreten. Gehen Sie bitte auf die vorige Seite zurück und versuchen die Aktion noch einmal. Sollte das Problem immer noch auftreten, nehmen Sie bitte Kontakt mit uns auf und schildern das Problem. Die Kontaktdaten finden Sie unter <?php echo $this->Html->link("Hilfe/Kontakt", array("controller" => "pages", "action" => "contact")) ?>
</p>
<?php if(Configure::read('debug') > 0): ?>
<p class="error">
	<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
	<?php echo h($error->getMessage()); ?>
	<br>

	<strong><?php echo __d('cake_dev', 'File'); ?>: </strong>
	<?php echo h($error->getFile()); ?>
	<br>

	<strong><?php echo __d('cake_dev', 'Line'); ?>: </strong>
	<?php echo h($error->getLine()); ?>
</p>
<?php endif ?>