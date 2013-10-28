<h2>Neuen Nutzer anlegen</h2>
<?php
	echo $this->Form->create("Seller");
	echo $this->Form->input("first_name", array("label" => "Vorname"));
	echo $this->Form->input("last_name", array("label" => "Nachname"));
	echo $this->Form->input("street", array("label" => "Straße"));
	echo $this->Form->input("zip_code", array("label" => "Postleitzahl"));
	echo $this->Form->input("city", array("label" => "Ort"));
	echo $this->Form->input("phone", array("label" => "Telefonnummer"));
	echo $this->Form->input("email", array("label" => "eMail-Adresse"));
	echo $this->Form->end("Speichern");
?>
