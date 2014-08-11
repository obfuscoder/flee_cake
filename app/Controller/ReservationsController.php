<?php

class ReservationsController extends AppController {
	public $components = array("Session");

	public function admin_index($eventId) {
		$reservations = $this->Reservation->findAllByEventId($eventId);
		$this->set("reservations", $reservations);
		$this->set("event_id", $eventId);
		$sellers = array();
		foreach ($this->Reservation->Seller->findAllUnreserved($eventId) as $seller) {
			$sellers[$seller["Seller"]["id"]] = $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] . " (" .
				$seller["Seller"]["email"] . ") - " . count($seller["Item"]) . " Artikel";
		}
		$this->set("sellers", $sellers);
	}

	public function admin_create() {
		$this->request->onlyAllow('post');
		$reservation = $this->request->data["Reservation"];
		if ($this->Reservation->add($reservation)) {
			$this->Session->setFlash("Reservierung durchgeführt", "default", array('class' => 'bg-success'));
		} else {
			$this->Session->setFlash("Reservierung fehlgeschlagen", "default", array('class' => 'bg-danger'));
		}
		return $this->redirect(array("action" => "index", $reservation["event_id"]));
	}

	public function admin_delete($id) {
		$this->request->onlyAllow('post', 'delete');
		$reservation = $this->Reservation->findById($id);
		if(!$reservation) {
			throw new NotFoundException("Die Reservierung konnte nicht gefunden werden");
		}
		$this->deleteAndInviteOthers($reservation);
		$this->Session->setFlash("Reservierung gelöscht", "default", array('class' => 'bg-success'));
		return $this->redirect(array("controller" => "reservations", "action" => "index", $reservation["Reservation"]["event_id"]));
	}

	public function delete($id) {
		$reservation = $this->Reservation->findById($id);
		if (!$reservation) {
			throw new NotFoundException("Die Reservierung konnte nicht gefunden werden.");
		}
		$seller = $this->Session->read("Seller");
		if (!$seller) {
			return $this->redirect (array("controller" => "pages", "action" => "session_expired"));
		}
		if ($seller["Seller"]["id"] != $reservation["Reservation"]["seller_id"]) {
			throw new ForbiddenException("Diese Aktion ist nicht zulässig.");
		}
		$this->deleteAndInviteOthers($reservation);
		$this->Session->setFlash("Reservierung wurde gelöscht", "default", array('class' => 'bg-success'));
		return $this->redirect(array("controller" => "items", "action" => "index", $seller["Seller"]["id"]));
	}

	private function deleteAndInviteOthers($reservation) {
		$this->Reservation->Seller->unnotify($reservation['Seller']['id']);
		$this->Reservation->delete($reservation['Reservation']['id']);
		if (strtotime($reservation["Event"]["reservation_start"]) < time() &&
			strtotime($reservation["Event"]["reservation_end"]) > time()) {
			$reservation_count = $this->Reservation->count($reservation["Event"]["id"]);
			if ($reservation_count < $reservation["Event"]["max_sellers"]) {
				$this->Reservation->Seller->sendNotifications($reservation);
			}
		}
	}
}

?>