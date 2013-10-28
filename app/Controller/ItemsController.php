<?php

class ItemsController extends AppController {
	public $helpers = array("Html", "Form", "Session", "Number");
	public $components = array("Session");

	private function checkSeller($sellerId) {
		if ($sellerId !== $this->Session->read("Seller")["Seller"]["id"]) {
			$this->Session->delete("Seller");
			return $this->redirect (array("controller" => "pages", "action" => "session_expired"));
		}
	}

	public function admin_index($sellerId) {
		$this->index($sellerId);
	}

	public function index($sellerId) {
		$this->checkSeller($sellerId);
		$items = $this->Item->findAllBySellerId($sellerId);
		$this->set("items", $items);
		$seller = $this->Item->Seller->findById($sellerId);
		$this->set("seller", $seller);
		$event = $this->Item->Seller->Reservation->Event->getCurrent();
		if ($event) {
			$this->set("event", $event);
			$reservation = $this->Item->Seller->Reservation->findBySellerIdAndEventId($sellerId, $event["Event"]["id"]);
			$this->set("reservation", $reservation);
		}
	}

	public function admin_create($sellerId) {
		$this->create($sellerId);
	}

	public function create($sellerId) {
		$this->checkSeller($sellerId);
		if ($this->request->isPost()) {
			$this->Item->create();
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__("Item has been created."), "default", array('class' => 'success'));
				return $this->redirect(array("action" => "index", $this->request->data["Item"]["seller_id"]));
			}
			$this->Session->setFlash(__("Unable to create item"));
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
		if ($this->request->isPut() || $this->request->isPost()) {
			$this->checkSeller($this->request->data["Item"]["seller_id"]);
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__("Item has been updated."), "default", array('class' => 'success'));
				return $this->redirect(array("action" => "index", $this->request->data["Item"]["seller_id"]));
			}
			$this->Session->setFlash(__("Unable to update item"));
		} else {
			$item = $this->Item->findById($id);
			$this->checkSeller($item["Item"]["seller_id"]);
			$this->request->data = $item;
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
			$this->Session->setFlash(__("The item has been deleted."), "default", array('class' => 'success'));
			return $this->redirect(array("action" => "index", $item["Item"]["seller_id"]));
		}
	}

	public function admin_label($reservationId) {
		$this->label($reservationId);
	}

	public function label($reservationId) {
        $reservation = $this->Item->Reservation->findById($reservationId);
		checkSeller($reservation["Reservation"]["seller_id"]);
        $reservedItemIds = array();
        foreach ($reservation["Item"] as $item) {
        	array_push($reservedItemIds, $item["id"]);
        }
        $reservedItemNumber = $this->Item->getNextReservedItemNumber($reservationId);
        $unreservedItemIds = $this->Item->find('list', array("fields" => array("id"), "conditions" => array("Item.seller_id" => $reservation["Seller"]["id"], "NOT" => array("Item.id" => $reservedItemIds))));
        $itemsToReserve = array();
        foreach ($unreservedItemIds as $itemId) {
        	array_push($itemsToReserve, array(
        		"ReservedItem" => array(
		        	"item_id" => $itemId,
        			"reservation_id" => $reservationId,
        			"number" => $reservedItemNumber,
        			"code" => $this->Item->getCode($reservation["Event"]["id"], $reservation["Reservation"]["number"], $reservedItemNumber)
        		)
        	));
        	$reservedItemNumber++;
		}
		if ($itemsToReserve) {
			$this->Item->ReservedItem->create();
			$this->Item->ReservedItem->saveAll($itemsToReserve);
		}
		$this->Session->setFlash("Es wurden " . count($unreservedItemIds) . " Etikett(en) erzeugt.", "default", array('class' => 'success'));
		return $this->redirect(array("action" => "index", $reservation["Seller"]["id"]));
	}

	public function admin_pdf($reservationId) {
		$this->pdf($reservationId);
		$this->render("pdf");
	}

	public function pdf($reservationId) {
        $reservation = $this->Item->Reservation->findById($reservationId);
		$this->checkSeller($reservation["Reservation"]["seller_id"]);
        $this->set("reservation", $this->Item->Reservation->findById($reservationId));

        $this->layout = 'pdf'; //this will use the pdf.ctp layout
	}
}

?>