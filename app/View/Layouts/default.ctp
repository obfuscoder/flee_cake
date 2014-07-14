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
	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('custom');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Flohmarkt Königsbach</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><?php echo $this->Html->link("Hauptseite", "/pages/home"); ?></li>
            <li><?php echo $this->Html->link("Teilnahmebedingungen", "/pages/terms"); ?></li>
            <li><?php echo $this->Html->link("Hilfe/Kontakt", "/pages/contact"); ?></li>
            <li><?php echo $this->Html->link("Impressum", "/pages/imprint"); ?></li>
            <li><?php echo $this->Html->link("Datenschutz", "/pages/privacy"); ?></li>
          </ul>
        </div>
      </div>
    </div>
	<div class="container">
		<h2><?php if ($title_for_layout == ""): ?>
			Flohmarkt Königsbach
			<?php else: ?>
			<?php echo $title_for_layout ?>
			<?php endif ?>
		</h2>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>

<?php
	if(Configure::read('debug') > 1) {
		echo $this->element('sql_dump');
    }
?>
<?php
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery-2.1.1.min');
?>
</body>
</html>
