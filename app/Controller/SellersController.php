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
		$this->set("reservations", $this->Seller->Reservation->findAllBySellerId($id));
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

	public function edit($id) {
		$seller = $this->Seller->findById($id);
		if ($this->request->isPut()) {
			if ($this->Seller->save($this->request->data)) {
				$this->Session->setFlash("Verkäufer aktualisiert.", "default", array('class' => 'success'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash("Verkäufer konnte nicht gespeichert werden.");
		} else {
			$this->request->data = $seller;
		}
	}

	function activateIfNecessary($seller) {
		$seller["Seller"]["active"] = true;
		unset($seller["Seller"]['modified']);
		$this->Seller->save($seller);
	}

	public function activate($token) {
		$seller = $this->getSellerOrShowFail($token);
		if (!$seller) {
			return;
		}
		$this->activateIfNecessary($seller);
	}

	private function getSellerOrShowFail($token) {
		$seller = $this->Seller->findByToken($token);
		if (empty($seller)) {
			$this->render("loginFailed");
			return false;
		}
		return $seller;
	}

	public function login($token) {
		$seller = $this->getSellerOrShowFail($token);
		if (!$seller) {
			return;
		}
		$this->activateIfNecessary($seller);
		return $this->redirect(array("controller" => "items", "action" => "index", $seller["Seller"]['id']));
	}

	public function delete($id = null) {
		$this->request->onlyAllow('post', 'delete');
		if ($this->Seller->delete($id)) {
			$this->Session->setFlash(__("The seller has been deleted."), "default", array('class' => 'success'));
			return $this->redirect(array("action" => "index"));
		}
	}

	public function reservation($token, $eventId) {
		$seller = $this->getSellerOrShowFail($token);
		if (!$seller) {
			return;
		}
		$this->set("seller", $seller);
		$event = $this->Seller->Reservation->Event->findById($eventId);
		$this->set("event", $event);
		foreach($seller["Reservation"] as $reservation) {
			if ($reservation["event_id"] == $eventId) {
				$this->set("reservation", $reservation);
				return $this->render("alreadyReserved");
			}
		}
		if (strtotime($event["Event"]["reservation_start"]) > time() || strtotime($event["Event"]["reservation_end"]) < time()) {
			return $this->render("reservationNotAllowed");
		}
		$reservation_count = $this->Seller->Reservation->find("count", array('conditions' => array('Reservation.event_id' => $eventId)));
		if ($reservation_count >= $event["Event"]["max_sellers"]) {
			return $this->render("reservationFull");
		}
		$reservationNumber = $this->Seller->Reservation->add(array("seller_id" => $seller["Seller"]["id"], "event_id" => $eventId));
		if (!$reservationNumber) {
			return $this->render("reservationFailed");
		}
		$this->set("number", $reservationNumber);
	}

	public function pdf($token, $eventId) {
		$seller = $this->getSellerOrShowFail($token);
		if (!$seller) {
			return;
		}
		$reservation = $this->Seller->Reservation->findByEventIdAndSellerId($eventId, $seller["Seller"]["id"]);
		if (!$reservation) {
			return $this->render("loginFailed");
		}
		return $this->redirect(array("controller" => "items", "action" => "pdf", $reservation["Reservation"]["id"]));
	}
}

?>