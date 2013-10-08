<?php

class CategoriesController extends AppController {
	public $helpers = array("Html", "Form", "Session");
	public $components = array("Session");

	public function index() {
		$this->set("categories", $this->Category->find("all"));
	}

	public function view($id) {
		$this->set("category", $this->Category->findById($id));
	}

	public function create() {
		if ($this->request->isPost()) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__("Category created."), "default", array('class' => 'success'));
				return $this->redirect(array("action" => "index"));
			}
			$this->Session->setFlash(__("Creating category failed!"));
		}
	}

	public function update($id) {
		if ($this->request->isPost()) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__("Category created."), "default", array('class' => 'success'));
				return $this->redirect(array("action" => "index"));
			}
			$this->Session->setFlash(__("Creating category failed!"));
		}
		if (!$this->request->data) {
			$this->request->data = $this->Category->findById($id);
		}
	}

	public function delete($id) {
		if ($this->request->isGet()) {
			throw new MethodNotAllowedException();
		}
		if ($this->Category->delete($id)) {
			$this->Session->setFlash(__("The category has been deleted."), "default", array('class' => 'success'));
			return $this->redirect(array("action" => "index"));
		}
	}
}

?>