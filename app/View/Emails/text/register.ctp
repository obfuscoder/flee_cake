Sehr geehrter Flohmarkt Interessent/sehr geehrte Interessentin,

Sie haben sich auf <?php echo $this->Html->url("/", true) ?> mit den folgenden Daten registriert:

<?php echo $first_name ?> <?php echo $last_name ?>

<?php echo $street ?>

<?php echo $zip_code ?> <?php echo $city ?>

Tel.: <?php echo $phone ?>

Mail: <?php echo $email ?>


Um Ihre Registrierung zu aktivieren, klicken Sie bitte auf den folgenden Link:

<?php echo $this->Html->url("/sellers/activate/$id", true) ?>


Um Ihre angebotenen Produkte zu verwalten, rufen Sie bitte den folgenden Link auf:

<?php echo $this->Html->url("/items/index/$id", true) ?>


Viele Grüße,
Ihr Flohmarkt-Team
