<?php

App::uses('CakeEmail', 'Network/Email');

class Mail extends AppModel {
	public function enqueue($to, $subject, $body) {
		$this->create();
		$this->save(array("Mail" => array("to" => $to, "subject" => $subject, "body" => $body)));
	}

	public function send($mail) {
		App::uses('CakeEmail', 'Network/Email');
		$cakeMail = new CakeEmail('default');
		$cakeMail->emailFormat("text")
			->to($mail["Mail"]["to"])
			->subject($mail["Mail"]["subject"])
			->send($mail["Mail"]["body"]);
		$this->id = $mail["Mail"]["id"];
		$this->saveField('sent', date("Y-m-d H:i:s"));
	}
}

?>