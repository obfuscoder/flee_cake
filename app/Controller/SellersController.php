<?php

class SellersController extends AppController {
	public $helpers = array("Html", "Form", "Session");
	public $components = array("Session");

	public function index() {
		$this->set("sellers", $this->Seller->find("all"));
	}

	public function view($id = null) {
		$seller = $this->Seller->findById($id);
		if (!$seller) {
			throw new NotFoundException(__("Invalid seller"));
		}
		$this->set("seller", $seller);
	}

	public function register() {
		if ($this->request->isPost()) {
			$this->Seller->create();
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
			$this->Session->setFlash(__("Unable to register seller"));
		}
	}

	public function activate() {
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