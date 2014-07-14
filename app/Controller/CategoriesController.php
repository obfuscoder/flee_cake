<?php

class CategoriesController extends AppController {
	public $helpers = array("Html", "Form", "Session");
	public $components = array("Session");

	public function admin_index() {
		$this->set("categories", $this->Category->find("all"));
	}

	public function admin_view($id) {
		$this->set("category", $this->Category->findById($id));
	}

	public function admin_create() {
		if ($this->request->isPost()) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash("Kategorie erstellt.", "default", array('class' => 'bg-success'));
				return $this->redirect(array("action" => "index"));
			}
			$this->Session->setFlash(__("Creating category failed!"));
		}
	}

	public function admin_update($id) {
		if ($this->request->is(array("post", "put"))) {
			$this->Category->id = $id;
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash("Änderung gespeichert", "default", array('class' => 'bg-success'));
				return $this->redirect(array("action" => "index"));
			}
			$this->Session->setFlash("Speichern der Kategorie fehlgeschlagen");
		}
		if (!$this->request->data) {
			$this->request->data = $this->Category->findById($id);
		}
	}

	public function admin_delete($id) {
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete($id)) {
			$this->Session->setFlash("Die Kategorie wurde gelöscht.", "default", array('class' => 'bg-success'));
			return $this->redirect(array("action" => "index"));
		}
	}
}

?>