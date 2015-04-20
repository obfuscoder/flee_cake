<?php
	echo $this->Form->create("Digest");
	echo $this->Form->input("u", array("label" => "Login"));
	echo $this->Form->input("p", array("label" => "Passwort"));
	echo $this->Form->end("Digest");
	if ($this->request->isPost()) {
		App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

        $passwordHasher = new SimplePasswordHasher();

		$digest = $this->request->data["Digest"];
		echo "Digest of " . $digest["u"] . " = " . $passwordHasher->hash($digest["p"]);
	}
?>