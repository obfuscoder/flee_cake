<?php

class ReservationsController extends AppController {
	public $components = array("Session");

	public function admin_index($eventId) {
		$reservations = $this->Reservation->findAllByEventId($eventId);
		$this->set("reservations", $reservations);
        $event = $this->Reservation->Event->findById($eventId);
        $this->set("event", $event);
		$this->set("event_id", $eventId);
		$sellers = array();
		foreach ($this->Reservation->Seller->findAllUnreserved($eventId) as $seller) {
			$sellers[$seller["Seller"]["id"]] = $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] . " (" .
				$seller["Seller"]["email"] . ") - PLZ: " . $seller["Seller"]["zip_code"] . " - " . count($seller["Item"]) . " Artikel";
		}
		$this->set("sellers", $sellers);
        $this->set("available_numbers", $this->Reservation->getAvailableNumbers($event));
	}

	public function admin_create() {
		$this->request->onlyAllow('post');
		$reservation = $this->request->data["Reservation"];
		if ($this->Reservation->add($reservation)) {
			$this->Session->setFlash("Reservierung durchgeführt", "default", array('class' => 'bg-success'));
		} else {
			$this->Session->setFlash("Reservierung fehlgeschlagen. Die Reserverierungsnummer ist bereits vergeben.", "default", array('class' => 'bg-danger'));
		}
		return $this->redirect(array("action" => "index", $reservation["event_id"]));
	}

    public function create($eventId) {
        $seller = $this->sellerFromSession();
        $event = $this->Reservation->Event->findById($eventId);
        $alreadyReserved = false;
        $reservation_count = $this->Reservation->count($eventId);
        foreach($seller["Reservation"] as $reservation) {
            if ($reservation["event_id"] == $eventId) {
                $alreadyReserved = true;
                break;
            }
        }
        if ($alreadyReserved) {
            $this->Session->setFlash("Sie haben bereits für diesen Termin eine Reservierung erhalten. " .
                "Ihre Reservierungsnummer ist " . $reservation["number"] . ".", "default", array('class' => 'bg-danger'));
        } elseif (strtotime($event["Event"]["reservation_start"]) > time()) {
			App::uses('CakeTime', 'Utility');
            $this->Session->setFlash("Die Reservierung ist nocht nicht freigeschaltet. " .
                "Bitte haben Sie Verständnis dafür, dass wir allen Interessenten die gleiche Chance geben wollen, " .
                "indem wir alle vorab per Mail über den Reservierungsbeginn informieren, und jeder die Zeit hat, " .
                "sich auf diesen Termin vorzubereiten. Sie können erst ab " .
				CakeTime::format($event["Event"]["reservation_start"], "%A, %e. %B %Y") .
                " um " . CakeTime::format($event["Event"]["reservation_start"], "%H:%M") . " Uhr " .
                "die Reservierung durchführen.",
                "default", array('class' => 'bg-danger'));
        } elseif (strtotime($event["Event"]["reservation_end"]) < time()) {
            $this->Session->setFlash("Die Reservierung ist leider nicht mehr möglich. " .
                "Der Veranstaltungstermin steht kurz bevor. Wir benötigen diese Vorlaufzeit, " .
                "um den Flohmarkt zu organisieren.", "default", array('class' => 'bg-danger'));
        } elseif ($reservation_count >= $event["Event"]["max_sellers"]) {
            $this->Session->setFlash("Leider sind bereits alle Verkäuferplätze reserviert. " .
                "Wir können Sie jedoch per eMail informieren, sobald der nächste Verkäuferplatz frei wird.",
                "default", array('class' => 'bg-danger'));
        } else {
            if ($this->request->isPost() || $event["Event"]["type"] == "commission") {
                $data = array("seller_id" => $seller["Seller"]["id"], "event_id" => $eventId);
                if ($event["Event"]["type"] != "commission") {
                    $data["number"] = $this->request->data["Reservation"]["number"];
                }
                $reservationNumber = $this->Reservation->add($data);
                if (!$reservationNumber) {
                    $this->Session->setFlash("Die Reservierung konnte leider nicht durchgeführt werden. " .
                        "Die Reservierungsnummer ist bereits vergeben.",
                        "default", array('class' => 'bg-danger'));
                    return;
                } else {
                    $this->Session->setFlash("Die Reservierung war erfolgreich. " .
                        "Ihre Reservierungsnummer lautet $reservationNumber.", "default", array('class' => 'bg-success'));
                }
            } else {
                $this->set("event", $event);
                $this->set("available_numbers", $this->Reservation->getAvailableNumbers($event));
                return;
            }
        }
        $this->redirect(array("controller" => "sellers", "action" => "view"));
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
		return $this->redirect(array("controller" => "sellers", "action" => "view"));
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