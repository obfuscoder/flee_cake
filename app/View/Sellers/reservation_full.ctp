<?php $this->set("title_for_layout", "Reservierung nicht möglich") ?>
<p>Leider sind alle Verkäuferplätze bereits reserviert.</p>
<p>Wir können Sie jedoch per eMail informieren, sobald der nächste Verkäuferplatz frei wird.</p>
<?php
	echo $this->Form->create(null, array("action" => "notify"));
	echo $this->Form->end("Ich möchte über den nächsten freien Verkäuferplatz informiert werden");
?>
