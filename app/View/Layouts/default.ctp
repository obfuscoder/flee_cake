<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo Configure::read('Brand.name') ?>
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

		echo $this->Html->script('jquery-2.1.1.min');
		echo $this->Html->script('bootstrap.min');

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
          	<?php if($this->Session->read("Admin")): ?>
          <?php echo $this->Html->link("Adminbereich", "/admin", array("class" => "navbar-brand")); ?>
          	<?php else: ?>
          <a class="navbar-brand" href="#"><?php echo Configure::read('Brand.name') ?></a>
        	<?php endif ?>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          	<?php if($this->Session->read("Admin")): ?>
			<li><?php echo $this->Html->link("Termine", "/admin/events"); ?></li>
			<li><?php echo $this->Html->link("Verkäufer", "/admin/sellers"); ?></li>
			<li><?php echo $this->Html->link("Kategorien", "/admin/categories"); ?></li>
			<li><?php echo $this->Html->link("Mails schreiben", "/admin/mails/send"); ?></li>
          	<?php else: ?>
            <li><?php echo $this->Html->link("Hauptseite", "/pages/home"); ?></li>
            <li><?php echo $this->Html->link("Teilnahmebedingungen", "/pages/terms"); ?></li>
            <li><?php echo $this->Html->link("Hilfe/Kontakt", "/pages/contact"); ?></li>
            <li><?php echo $this->Html->link("Ihr Flohmarkt", "/pages/my_basar"); ?></li>
            <li><?php echo $this->Html->link("Impressum", "/pages/imprint"); ?></li>
            <li><?php echo $this->Html->link("Datenschutz", "/pages/privacy"); ?></li>
        	<?php endif ?>
          </ul>
        </div>
      </div>
    </div>
	<div class="container">
		<h2><?php if ($title_for_layout == ""): ?>
			<?php echo Configure::read('Brand.name') ?>
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
</body>
</html>
