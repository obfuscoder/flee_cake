<?php $this->set("title_for_layout", "Registrierung") ?>
<p>
	Sie können sich hier für den kommenden und zukünftige Flohmärkte als Interessent für den Verkauf von Kommissionsware registrieren.
	Die erfassten Daten dienen in erster Linie dazu, um Sie hinsichtlich des weiteren Ablaufs des kommenden Flohmarkts zu kontaktieren und informieren.
	In der Regel findet dies per eMail statt. Auch die Zugangsinformationen zum geschützten Bereich erhalten Sie per Mail. Die Telefonnummer wird benötigt, damit wir Sie in dringenden Fällen (bspw. Ware verlorengegangen, anderweitig nicht erreichbar) anrufen können. Die Adressdaten dienen der Abrechnung. Ebenso werden wir zum Schutz Ihrer Daten Ihre Eingaben erfragen, sollten Sie mit uns telefonisch Kontakt aufnehmen.
	Alle Pflichtfelder sind <span class="required-example">entsprechend</span> gekennzeichnet.</p>
<?php
	echo $this->Form->create("Seller");
	echo $this->Form->input("first_name", array("label" => "Vorname"));
	echo $this->Form->input("last_name", array("label" => "Nachname"));
	echo $this->Form->input("street", array("label" => "Straße"));
	echo $this->Form->input("zip_code", array("label" => "Postleitzahl"));
	echo $this->Form->input("city", array("label" => "Ort"));
	echo $this->Form->input("phone", array("label" => "Telefonnummer"));
	echo $this->Form->input("email", array("label" => "eMail-Adresse"));
	echo $this->Form->end("Registrieren");
?>
