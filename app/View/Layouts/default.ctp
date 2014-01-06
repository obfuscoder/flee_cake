<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Flohmarkt Königsbach
		<?php if ($title_for_layout != ""): ?>
			-
			<?php echo $title_for_layout; ?>
		<?php endif ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="content">
			<h2><?php if ($title_for_layout == ""): ?>
				Flohmarkt Königsbach
				<?php else: ?>
				<?php echo $title_for_layout ?>
				<?php endif ?>
			</h2>
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<div id="footer">
		<?php echo $this->Html->link("Hilfe/Kontakt", "/pages/contact"); ?>
		<?php echo $this->Html->link("Impressum", "/pages/imprint"); ?>
		<?php echo $this->Html->link("Datenschutz", "/pages/privacy"); ?>
	</div>

<?php
	if(Configure::read('debug') > 1) {
		echo $this->element('sql_dump');
    }
?>
</body>
</html>
