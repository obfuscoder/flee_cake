<?php
	echo $this->Form->create("Digest");
	echo $this->Form->input("u", array("label" => "Login"));
	echo $this->Form->input("p", array("label" => "Passwort"));
	echo $this->Form->end("Digest");
	if ($this->request->isPost()) {
		$digest = $this->request->data["Digest"];
		App::uses('DigestAuthenticate', 'Controller/Component/Auth');
		echo "Digest = " . DigestAuthenticate::password($digest["u"], $digest["p"], env('SERVER_NAME'));
	}
?>