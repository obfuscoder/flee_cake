<?php $this->set("title_for_layout", "Sie haben sich bereits registriert?") ?>
<p>Sie finden den Link zu Ihren Artikeln in Ihrer Registrierungsbestätigung.</p>
<p>Sie können sich diese eMail nochmals zusenden lassen. Geben Sie dazu bitte hier die eMail-Adresse an, die Sie bei der Registrierung verwendet haben:</p>
<?php
	echo $this->Form->create("Seller");
	echo $this->Form->input("email", array("label" => "eMail-Adresse"));
	echo $this->Form->end("Registrierungsbestätigung nochmals zusenden");
	echo $this->Html->link("Zurück zur Hauptseite", "/");
?>
