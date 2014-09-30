Sehr geehrter Flohmarkt Interessent/sehr geehrte Interessentin,

Sie haben sich auf <?php echo $this->Html->url("/", true) ?> mit den folgenden Daten registriert:

<?php echo $first_name ?> <?php echo $last_name ?>

<?php echo $street ?>

<?php echo $zip_code ?> <?php echo $city ?>

Tel.: <?php echo $phone ?>

Mail: <?php echo $email ?>


Um Ihre Registrierung zu aktivieren, klicken Sie bitte auf den folgenden Link:

<?php echo $this->Html->url("/sellers/activate/$token", true) ?>


Den Zugang zu Ihrem geschützten Bereich zum Bearbeiten Ihrer persönlichen Daten sowie zum Bearbeiten Ihrer Artikel zum Verkauf auf Kommissionsflohmärkten erreichen Sie über den folgenden Link:

<?php echo $this->Html->url("/sellers/login/$token", true) ?>


Bitte bewahren Sie diesen Link gut auf und schicken Sie diesen nicht an Dritte weiter.


Viele Grüße,
Ihr Flohmarkt-Team
