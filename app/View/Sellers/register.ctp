<?php $this->set("title_for_layout", "Registrierung") ?>
<p>
	Sie können sich hier für den kommenden und zukünftige Flohmärkte als Interessent für den Verkauf von Kommissionsware registrieren.
	Die erfassten Daten dienen in erster Linie dazu, um Sie hinsichtlich des weiteren Ablaufs des kommenden Flohmarkts zu kontaktieren und informieren.
	In der Regel findet dies per eMail statt. Auch die Zugangsinformationen zum geschützten Bereich erhalten Sie per Mail. Die Telefonnummer wird benötigt, damit wir Sie in dringenden Fällen (bspw. Ware verlorengegangen, anderweitig nicht erreichbar) anrufen können. Die Adressdaten dienen der Abrechnung. Ebenso werden wir zum Schutz Ihrer Daten Ihre Eingaben erfragen, sollten Sie mit uns telefonisch Kontakt aufnehmen.
	Alle Pflichtfelder sind <span class="required-example">entsprechend</span> gekennzeichnet.</p>
<?php
	echo $this->Form->create("Seller");
	echo $this->Form->input("first_name");
	echo $this->Form->input("last_name");
	echo $this->Form->input("street");
?>
<div class="row">
<?php
	echo $this->Form->input("zip_code", array("div" => array("class" => "form-group col-sm-2")));
	echo $this->Form->input("city", array("div" => array("class" => "form-group col-sm-10")));
?>
</div>
<?php
	echo $this->Form->input("phone");
	echo $this->Form->input("email");
	echo $this->Form->end(array("label" => "Registrieren", "div" => false, "class" => "btn btn-primary"));
?>
