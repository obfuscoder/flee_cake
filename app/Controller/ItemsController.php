<?php

class ItemsController extends AppController {
	public $helpers = array("Html", "Form", "Session", "Number");
	public $components = array("Session");

	public function index($sellerId) {
		$items = $this->Item->findAllBySellerId($sellerId);
		$this->set("items", $items);
		$this->set("seller_id", $sellerId);
	}

	public function create($sellerId) {
		if ($this->request->isPost()) {
			$this->Item->create();
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__("Item has been created."), "default", array('class' => 'success'));
				return $this->redirect(array("action" => "index", $this->request->data["Item"]["seller_id"]));
			}
			$this->Session->setFlash(__("Unable to create item"));
		}
		$item = $this->Item->create();
		$this->set("categories", $this->Item->Category->find("list", array("order" => "name")));
		$item["Item"]["seller_id"] = $sellerId;
		$this->request->data = $item;
		$this->render("edit");
	}

	public function update($id) {
		if ($this->request->isPut() || $this->request->isPost()) {
			debug($this->request->data);
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__("Item has been updated."), "default", array('class' => 'success'));
				return $this->redirect(array("action" => "index", $this->request->data["Item"]["seller_id"]));
			}
			$this->Session->setFlash(__("Unable to update item"));
		}
		$item = $this->Item->findById($id);
		$this->set("categories", $this->Item->Category->find("list", array("order" => "name")));
		$this->request->data = $item;
		$this->render("edit");
	}

	public function delete($id) {
		if ($this->request->isGet()) {
			throw new MethodNotAllowedException();
		}
		$item = $this->Item->findById($id);
		debug($item);
		if ($this->Item->delete($id)) {
			$this->Session->setFlash(__("The item has been deleted."), "default", array('class' => 'success'));
			return $this->redirect(array("action" => "index", $item["Item"]["seller_id"]));
		}
	}

	public function pdf($sellerId) {
        //Configure::write('debug',0); // Otherwise we cannot use this method while developing

        $items = $this->Item->findAllBySellerId($sellerId);
        $this->set("items", $items);
        
        $this->layout = 'pdf'; //this will use the pdf.ctp layout
        $this->render(); 
	}
}

?>