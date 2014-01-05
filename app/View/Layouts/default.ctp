<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Flohmarkt Königsbach -
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="content">
			<h2><?php echo $title_for_layout ?></h2>

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
	if(!isset($_SERVER['SERVER_NAME']) || $_SERVER['SERVER_NAME'] == 'localhost') {
		echo $this->element('sql_dump');
    }
?>
</body>
</html>
