<?php $this->set("title_for_layout", "Stammdaten bearbeiten") ?>
<?php
	echo $this->Form->create("Seller");
	echo $this->Form->input('id');
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
	echo $this->Form->submitButton("Änderungen speichern");
	echo $this->Html->cancelLink("Zurück ohne Speichern der Änderungen", array('action' => 'view'));
	echo $this->Form->end();
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>eMail Benachrichtigungen</h3>
<?php if (isset($this->request->data["Seller"]["nomail"]) && $this->request->data["Seller"]["nomail"]): ?>
<p>Aktuell erhalten Sie keinerlei Benachrichtigungen von uns. Möchten Sie in Zukunft wieder Benachrichtigungen erhalten, benutzen Sie den folgenden Link:</p>
<p><?php echo $this->Html->iconLink("envelope", "Ich möchte in Zukunft Benachrichtigungen erhalten", array('action' => 'startmail'), array("class" => "btn btn-success")); ?></p>
<?php else: ?>
<p>Aktuell informieren wir Sie über anstehende Termine und stattfindende Flohmärkte. Möchten Sie keine Benachrichtigungen mehr von uns erhalten, benutzen Sie den folgenden Link. Sie können sich weiterhin anmelden und sich selbst über Neuigkeiten informieren. Die Benachrichtigung können Sie jederzeit wieder aktivieren.</p>
<p><?php echo $this->Html->iconLink("ban-circle", "Ich möchte keine eMails mehr erhalten", array('action' => 'stopmail'), array("class" => "btn btn-warning")); ?></p>
<?php endif ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>Daten löschen</h3>
<p>Mit dem folgenden Link können Sie alle Ihre Daten inklusive aller Artikel und Reservierungen löschen. Sie können sich jederzeit wieder neu registrieren. Ihre bisher eingebenen Daten sind aber unwiderruflich verloren.</p>
<p><?php echo $this->Form->deleteButton("Ich möchte mich abmelden und meine Daten löschen", array('action' => 'delete'), "Sind Sie sicher, dass Sie Ihre Daten löschen wollen? Sie verlieren damit unwiderruflich alle Artikel und Reservierungen."); ?></p>
