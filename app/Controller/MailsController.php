<?php

App::uses('AppModel', 'Model');
App::uses('Seller', 'Model');

class MailsController extends AppController {

	public function worker() {
		$unsentMails = $this->Mail->findAllBySent(null);
		$maxi = min(100,count($unsentMails));
		for($i=0; $i<$maxi; $i++) {
			$this->Mail->send($unsentMails[$i]);
		}
		$this->set("sent", $maxi);
		$this->set("rest", count($unsentMails)-$maxi);

		$this->response->type('plain');
        $this->layout = 'plain';
	}

	public function admin_send() {
		$seller = new Seller();
		if ($this->request->isPost()) {
			App::uses('CakeEmail', 'Network/Email');
			$mail = new CakeEmail('queue');
			foreach($this->request->data["Mail"]["to"] as $to) {
				$recipient = $seller->findById($to);
				$mail->emailFormat("text")
					->to($recipient["Seller"]["email"])
					->subject($this->request->data["Mail"]["subject"])
					->send($this->replace_placeholders($this->request->data["Mail"]["body"], $recipient));
			}
			$this->Session->setFlash(count($this->request->data["Mail"]["to"]) . " Mails wurden versendet.", "default", array('class' => 'bg-success'));
		}
		$sellers = $seller->find("all", array(
			"fields" => array("Seller.id", "Seller.first_name", "Seller.last_name", "Seller.email", "Seller.active", "Seller.notify"),
			"conditions" => array("nomail is null or nomail <> 1"),
			"order" => array("Seller.first_name", "Seller.last_name")
		));
		$this->set("sellers", $sellers);
	}

	private function replace_placeholders($text, $seller) {
		return str_replace("{{login_link}}", Router::url(
			array('controller' => 'sellers', 'action' => 'login', 'admin' => false, $seller["Seller"]["token"]), true), $text);
	}
}

?>