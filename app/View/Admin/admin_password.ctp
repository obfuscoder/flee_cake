<?php $this->set("title_for_layout", "Passwort ändern") ?>
<?php
echo $this->Form->create("User");
echo $this->Form->input("old_password", array("label" => "Aktuelles Passwort", "type" => "password"));
echo $this->Form->input("password", array("label" => "Neues Passwort", "type" => "password"));
echo $this->Form->input("password_again", array("label" => "Neues Passwort (Wiederholung)", "type" => "password"));
echo $this->Form->submitButton("Aktualisieren");
echo $this->Form->end();
?>
