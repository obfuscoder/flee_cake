<?php

class SellersController extends AppController {
	public $helpers = array("Html", "Form", "Session", "Time");
	public $components = array("Session");

	function lastUpdated($seller) {
		$updated = $seller["Seller"]["modified"];
		foreach ($seller["Item"] as $item) {
			if ($updated < $item["modified"]) {
				$updated = $item["modified"];
			}
		}
		return $updated;
	}

	public function index() {
		$sellers = $this->Seller->find("all");
		for($i=0; $i<count($sellers); $i++) {
			$sellers[$i]["Seller"]["lastUpdated"] = $this->lastUpdated($sellers[$i]);
		}
		$this->set("sellers", $sellers);
	}

	public function view($id = null) {
		$seller = $this->Seller->findById($id);
		if (!$seller) {
			throw new NotFoundException(__("Invalid seller"));
		}
		$this->set("seller", $seller);
	}

	public function terms() {
	}

	public function register() {
		if ($this->request->isPost()) {
			$this->Seller->create();
			$this->request->data["Seller"]["token"] = md5(uniqid("Vs3_%&/90kF307iohjSD2", true));
			if ($seller = $this->Seller->save($this->request->data)) {
				App::uses('CakeEmail', 'Network/Email');
				$mail = new CakeEmail();
				$mail->template("register", "default")
					->emailFormat("text")
					->from(array("flohmarkt@obfusco.de" => "Flohmarkt Königsbach"))
					->to($this->request->data["Seller"]["email"])
					->subject("Registrierungsbestätigung")
					->viewVars($seller["Seller"])
					->send();
				return $this->render("registered");
			}
			$this->Session->setFlash("Registrierung fehlgeschlagen!");
		}
	}

	function activateIfNecessary($seller) {
		$seller["Seller"]["active"] = true;
		unset($seller["Seller"]['modified']);
		$this->Seller->save($seller);
	}

	public function activate($token) {
		$seller = $this->Seller->findByToken($token);
		if (empty($seller)) {
			return $this->render("activationFailed");
		}
		$this->activateIfNecessary($seller);
	}

	public function login($token) {
		$seller = $this->Seller->findByToken($token);
		if (empty($seller)) {
			return $this->render("loginFailed");
		}
		$this->activateIfNecessary($seller);
		return $this->redirect(array("controller" => "items", "action" => "index", $seller["Seller"]['id']));
	}

	public function delete($id = null) {
		if ($this->request->isGet()) {
			throw new MethodNotAllowedException();
		}
		if ($this->Seller->delete($id)) {
			$this->Session->setFlash(__("The seller has been deleted."), "default", array('class' => 'success'));
			return $this->redirect(array("action" => "index"));
		}
	}
}

?>