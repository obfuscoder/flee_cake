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
			foreach($this->request->data["Mail"]["to"] as $to) {
				$recipient = $seller->findById($to);
				$this->Mail->enqueue($recipient["Seller"]["email"], $this->request->data["Mail"]["subject"], $this->replace_placeholders($this->request->data["Mail"]["body"], $recipient));
			}
			$this->Session->setFlash(count($this->request->data["Mail"]["to"]) . " Mails wurden versendet.", "default", array('class' => 'bg-success'));
		}
		$sellers = $seller->find("all", array("order" => array("first_name", "last_name"), "conditions" => array("nomail is null or nomail <> 1")));
		$this->set("sellers", $sellers);
	}

	private function replace_placeholders($text, $seller) {
		return str_replace("{{login_link}}", Router::url(
			array('controller' => 'sellers', 'action' => 'login', 'admin' => false, $seller["Seller"]["token"]), true), $text);
	}
}

?>