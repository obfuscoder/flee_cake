<?php

class ItemsController extends AppController {
	public $components = array("Session");

	private function checkSeller($sellerId) {
		if ($this->Session->read("Admin")) {
			return true;
		}
		$sessionSeller = $this->Session->read("Seller");
		if ($sellerId !== $sessionSeller["Seller"]["id"]) {
			$this->Session->delete("Seller");
			return $this->redirect (array("controller" => "pages", "action" => "session_expired"));
		}
	}

	public function admin_index($sellerId = null) {
		if ($sellerId == null) {
			$seller = $this->sellerFromSession();
			$sellerId = $seller["Seller"]["id"];
		} else {
			$seller = $this->Item->Seller->findById($sellerId);
			$this->Session->write("Seller", $seller);
		}
		$this->index();
		$this->render('index');
	}

	public function index() {
		$seller = $this->sellerFromSession();
		$sellerId = $seller["Seller"]["id"];
		$items = $this->Item->findAllBySellerId($sellerId);
		$this->set("items", $items);
		$this->set("seller", $seller);
		$event = $this->Item->Seller->Reservation->Event->getCurrent();
		if ($event) {
			$this->set("event", $event);
			$reservation = $this->Item->Seller->Reservation->findBySellerIdAndEventId($sellerId, $event["Event"]["id"]);
			$this->set("reservation", $reservation);
		}
	}

	public function admin_create($sellerId = null) {
		if ($sellerId == null) {
			$seller = $this->sellerFromSession();
			$sellerId = $seller["Seller"]["id"];
		} else {
			$seller = $this->Item->Seller->findById($sellerId);
			$this->Session->write("Seller", $seller);
		}
		$this->create();
	}

	public function create() {
		$seller = $this->sellerFromSession();
		$sellerId = $seller["Seller"]["id"];
		if ($this->request->isPost()) {
			$this->Item->create();
	        $this->request->data['Item']['price'] = str_replace(",", ".", $this->request->data['Item']['price']);
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__("Item has been created."), "default", array('class' => 'bg-success'));
				return $this->redirect(array("action" => "index"));
			}
        	$this->request->data['Item']['price'] = CakeNumber::currency(
        		$this->request->data['Item']['price'], "EUR", array("before" => false, "after" => false));
			$this->Session->setFlash(__("Unable to create item"), "default", array('class' => 'bg-danger'));
		} else {
			$item = $this->Item->create();
			$item["Item"]["seller_id"] = $sellerId;
			$this->request->data = $item;
		}
		$this->set("categories", $this->Item->Category->find("list", array("order" => "name")));
		$this->render("edit");
	}

	public function admin_update($id) {
		$this->update($id);
	}

	public function update($id) {
		App::uses('CakeNumber', 'Utility');
		if ($this->request->isPut() || $this->request->isPost()) {
			$this->checkSeller($this->request->data["Item"]["seller_id"]);
	        $this->request->data['Item']['price'] = str_replace(",", ".", $this->request->data['Item']['price']);
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__("Item has been updated."), "default", array('class' => 'bg-success'));
				return $this->redirect(array("action" => "index"));
			}
        	$this->request->data['Item']['price'] = CakeNumber::currency(
        		$this->request->data['Item']['price'], "EUR", array("before" => false, "after" => false));
			$this->Session->setFlash(__("Unable to update item"), "default", array('class' => 'bg-danger'));
		} else {
			$item = $this->Item->findById($id);
			$this->checkSeller($item["Item"]["seller_id"]);
			$this->request->data = $item;
        	$this->request->data['Item']['price'] = CakeNumber::currency(
        		$this->request->data['Item']['price'], "EUR", array("before" => false, "after" => false));
		}
		$this->set("categories", $this->Item->Category->find("list", array("order" => "name")));
		$this->render("edit");
	}

	public function admin_delete($id) {
		$this->delete($id);
	}

	public function delete($id) {
		$this->request->onlyAllow('post', 'delete');
		$item = $this->Item->findById($id);
		$this->checkSeller($item["Item"]["seller_id"]);
		if ($this->Item->delete($id)) {
			$this->Session->setFlash(__("The item has been deleted."), "default", array('class' => 'bg-success'));
			return $this->redirect(array("action" => "index"));
		}
	}

	public function admin_label($reservationId) {
		$this->label($reservationId);
	}

	public function label($reservationId) {
        $reservation = $this->Item->Reservation->findById($reservationId);
		$this->checkSeller($reservation["Reservation"]["seller_id"]);
		$createdLabelCount = $this->Item->label($reservation);
		$this->Session->setFlash("Es wurden " . $createdLabelCount . " Etikett(en) erzeugt.", "default", array('class' => 'bg-success'));
		return $this->redirect(array("action" => "index"));
	}

	public function admin_pdf($reservationId) {
		$this->pdf($reservationId);
		$this->render("pdf");
	}

	public function pdf($reservationId) {
        $reservation = $this->Item->Reservation->findById($reservationId);
		$this->checkSeller($reservation["Reservation"]["seller_id"]);
		$this->set("categories", $this->Item->Category->find('list'));
        $this->set("reservation", $this->Item->Reservation->findById($reservationId));

        $this->layout = 'pdf'; //this will use the pdf.ctp layout
	}
}

?>