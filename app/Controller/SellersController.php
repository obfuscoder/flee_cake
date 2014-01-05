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

	public function admin_index() {
		$sellers = $this->Seller->find("all");
		for($i=0; $i<count($sellers); $i++) {
			$sellers[$i]["Seller"]["lastUpdated"] = $this->lastUpdated($sellers[$i]);
		}
		$this->set("sellers", $sellers);
	}

	public function admin_view($id = null) {
		$seller = $this->Seller->findById($id);
		if (!$seller) {
			throw new NotFoundException(__("Invalid seller"));
		}
		$this->set("seller", $seller);
		$this->set("reservations", $this->Seller->Reservation->findAllBySellerId($id));
	}

	public function terms() {
	}

	public function admin_new() {
		if ($this->request->isPost()) {
			if ($this->create()) {
				$this->Session->setFlash("Verkäufer gespeichert", "default", array('class' => 'success'));
				return $this->redirect(array("action" => "index"));
			}
		}
	}

	public function create() {
		if ($this->request->isPost()) {
			$this->Seller->create();
			$this->request->data["Seller"]["token"] = md5(uniqid("Vs3_%&/90kF307iohjSD2", true));
			if ($seller = $this->Seller->save($this->request->data)) {
				$this->send_registration_mail($seller);
			} else {
				$this->Session->setFlash("Registrierung fehlgeschlagen!");
			}
			return $seller;
		}
	}

	public function register() {
		if ($this->request->isPost()) {
			if ($this->create()) {
				return $this->render("registered");
			}
		}
	}

	public function admin_edit($id) {
		$seller = $this->Seller->findById($id);
		if ($this->request->isPut()) {
			if ($this->Seller->save($this->request->data)) {
				$this->Session->setFlash("Verkäufer aktualisiert.", "default", array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash("Verkäufer konnte nicht gespeichert werden.");
		} else {
			$this->request->data = $seller;
		}
	}

	function activateIfNecessary($seller) {
		if ($seller["Seller"]["active"]) {
			return;
		}
		$seller["Seller"]["active"] = true;
		unset($seller["Seller"]['modified']);
		$this->Seller->save($seller);
		$future_events_to_invite_to = $this->Seller->Reservation->Event->getFutureWithSentInvitation();
		foreach ($future_events_to_invite_to as $event) {
			$this->Seller->sendInvitation($seller, $event);
		}
	}

	public function activate($token) {
		$seller = $this->auth($token);
		$this->set("seller", $seller);
		$reservable_events = $this->Seller->Reservation->Event->getReservable();
		$future_events = $this->Seller->Reservation->Event->find("all", array("conditions" => "now() < Event.reservation_start"));
		$this->set("reservable_events", $reservable_events);
		$this->set("future_events", $future_events);
	}

	private function auth($token) {
		$seller = $this->Seller->findByToken($token);
		if (!$seller) {
			return $this->redirect(array("action" => "auth_failed"));
		}
		$this->activateIfNecessary($seller);
		$this->Session->write("Seller", $seller);
		return $seller;
	}

	public function login($token) {
		$seller = $this->auth($token);
		return $this->redirect(array("controller" => "items", "action" => "index", $seller["Seller"]['id']));
	}

	public function admin_delete($id = null) {
		$this->request->onlyAllow('post', 'delete');
		if ($this->Seller->delete($id)) {
			$this->Session->setFlash(__("The seller has been deleted."), "default", array('class' => 'success'));
			return $this->redirect(array("action" => "index"));
		}
	}

	public function reservation($token, $eventId) {
		$seller = $this->auth($token);
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
		$seller = $this->auth($token);
		$reservation = $this->Seller->Reservation->findByEventIdAndSellerId($eventId, $seller["Seller"]["id"]);
		if (!$reservation) {
			return $this->render("loginFailed");
		}
		return $this->redirect(array("controller" => "items", "action" => "pdf", $reservation["Reservation"]["id"]));
	}

	public function already_registered() {
		if ($this->request->isPost()) {
			$seller = $this->Seller->findByEmail($this->request->data['Seller']['email']);
			if (!$seller) {
				$this->Session->setFlash('Es konnte kein Nutzer mit dieser eMail-Adresse gefunden werden. Bitte überprüfen Sie Ihre Eingabe oder registrieren Sie sich neu.');
				return;
			}
			$this->send_registration_mail($seller);
			return $this->render("registration_resent");
		}
	}

	private function send_registration_mail($seller) {
		App::uses('CakeEmail', 'Network/Email');
		$mail = new CakeEmail('default');
		$mail->template("register", "default")
			->emailFormat("text")
			->to($this->request->data["Seller"]["email"])
			->subject("Registrierungsbestätigung")
			->viewVars($seller["Seller"])
			->send();
	}

	public function notify() {
		$this->request->onlyAllow('post');
		$seller = $this->Session->read("Seller");
		if (!$seller) {
			return $this->redirect (array("controller" => "pages", "action" => "session_expired"));
		}
		$this->Seller->notify($seller["Seller"]["id"]);
		$this->set("seller", $seller);
	}
}

?>