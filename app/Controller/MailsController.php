<?php

App::uses('AppModel', 'Model');
App::uses('Seller', 'Model');

class MailsController extends AppController {
	public $components = array("Session");

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
		if (!$this->Session->read("Admin")) {
			return $this->redirect (array("controller" => "pages", "action" => "unauthorized"));
		}
		if ($this->request->isPost()) {
			foreach($this->request->data["Mail"]["to"] as $to) {
				$this->Mail->enqueue($to, $this->request->data["Mail"]["subject"], $this->request->data["Mail"]["body"]);
			}
			$this->Session->setFlash(count($this->request->data["Mail"]["to"]) . " Mails wurden versendet.", "default", array('class' => 'bg-success'));
		}
		$seller = new Seller();
		$sellers = $seller->find("all", array("order" => array("first_name", "last_name"), "conditions" => array("nomail is null or nomail <> 1")));
		$this->set("sellers", $sellers);
	}
}

?>