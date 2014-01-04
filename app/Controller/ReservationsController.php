<?php

class ReservationsController extends AppController {
	public $helpers = array("Html", "Form", "Session", "Number");
	public $components = array("Session");

	public function admin_index($eventId) {
		$reservations = $this->Reservation->findAllByEventId($eventId);
		$this->set("reservations", $reservations);
		$this->set("event_id", $eventId);
		$sellers = $this->Reservation->Seller->findAllUnreserved($eventId);
		$unreserved_sellers = array();
		foreach ($sellers as $seller) {
			$unreserved_sellers[$seller["Seller"]["id"]] = $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"];
		}
		$this->set("sellers", $unreserved_sellers);
	}

	public function admin_create() {
		$this->request->onlyAllow('post');
		$reservation = $this->request->data["Reservation"];
		if ($this->Reservation->add($reservation)) {
			$this->Session->setFlash("Reservierung durchgeführt", "default", array('class' => 'success'));
		} else {
			$this->Session->setFlash("Reservierung fehlgeschlagen");
		}
		return $this->redirect(array("action" => "index", $reservation["event_id"]));
	}

	public function admin_delete($id) {
		$this->request->onlyAllow('post', 'delete');
		$reservation = $this->Reservation->findById($id);
		if ($this->Reservation->delete($id)) {
			$this->Session->setFlash("Reservierung gelöscht", "default", array('class' => 'success'));
			return $this->redirect(array("controller" => "reservations", "action" => "index", $reservation["Reservation"]["event_id"]));
		}
	}

	public function delete($id) {
		$reservation = $this->Reservation->findById($id);
		if (!$reservation) {
			throw new NotFoundException("Die Reservierung konnte nicht gefunden werden.");
		}
		$seller = $this->Session->read("Seller");
		if ($seller["Seller"]["id"] != $reservation["Reservation"]["seller_id"]) {
			throw new ForbiddenException("Diese Aktion ist nicht zulässig.");
		}
		if ($this->Reservation->delete($id)) {
			$this->Session->setFlash("Reservierung wurde gelöscht", "default", array('class' => 'success'));
			return $this->redirect(array("controller" => "items", "action" => "index", $seller["Seller"]["id"]));
		}
	}
}

?>