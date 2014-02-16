<?php
App::uses('AppController', 'Controller');

class EventsController extends AppController {
	public $helpers = array("Html", "Form", "Session", "Time");
	public $components = array('Paginator');

	public function admin_index() {
		$this->Event->recursive = 0;
		$this->set('events', $this->Paginator->paginate());
	}

	public function admin_view($id = null) {
		$this->set('event', $this->Event->findById($id));
		$this->set('reservations', $this->Event->Reservation->findAllByEventId($id));
	}

	public function admin_add() {
		if ($this->request->isPost()) {
			$this->Event->create();
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash("Das Ereignis wurde erfolgreich hinzugefügt.", "default", array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash("Das Ereignis konnte nicht gespeichert werden.");
		}
	}

	public function admin_edit($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash("Das Ereignis wurde erfolgreich aktualisiert.", "default", array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash("Das Ereignis konnte nicht gespeichert werden.");
		} else {
			$this->request->data = $this->Event->findById($id);
		}
	}

	public function admin_delete($id = null) {
		$this->Event->id = $id;
		$this->request->onlyAllow('post', 'delete');
		if ($this->Event->delete($id)) {
			$this->Session->setFlash("Ereignis gelöscht.", "default", array('class' => 'success'));
		} else {
			$this->Session->setFlash("Ereignis konnte nicht gelöscht werden.");
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_invite($id) {
		$event = $this->Event->findById($id);
		if ($event["Event"]["invitation_sent"] !== null) {
			App::uses('CakeTime', 'Utility');
			$this->Session->setFlash("Die Einladung für diesen Termin wurde bereits " .
				CakeTime::timeAgoInWords($event["Event"]["invitation_sent"], array('format' => 'd.m.Y')) . " versendet.");
		} else {
			$reservations = count($event["Reservation"]);
			$invitationCount = $this->sendInvitations($event);
			$this->Session->setFlash(
				"Es wurden $invitationCount Einladung(en) verschickt. Es gibt bereits $reservations Reservierung(en).",
				"default", array('class' => 'success'));
		}
		return $this->redirect(array('action' => 'view', $id));
	}

	private function sendInvitations($event) {
		$invitationCount = $this->Event->Reservation->Seller->sendInvitationsToUnreserved($event);
		$event["Event"]["invitation_sent"] = date("Y-m-d H:i:s");
		$this->Event->save($event);
		return $invitationCount;
	}

	public function admin_mail_closing($id) {
		$event = $this->Event->findById($id);
		if ($event["Event"]["closing_sent"] !== null) {
			App::uses('CakeTime', 'Utility');
			$this->Session->setFlash("Die Mail wurde bereits " .
				CakeTime::timeAgoInWords($event["Event"]["closing_sent"], array('format' => 'd.m.Y')) . " versendet.");
		} else {
			$reservations = count($event["Reservation"]);
			$mailCount = $this->sendClosingMails($event);
			$this->Session->setFlash(
				"Es wurden $mailCount Mail(s) verschickt.",
				"default", array('class' => 'success'));
		}
		return $this->redirect(array('action' => 'view', $id));
	}

	private function sendClosingMails($event) {
		$id = $event["Event"]["id"];
		$reservations = $this->Event->Reservation->findAllByEventId($id);
		App::uses('CakeEmail', 'Network/Email');
		$mail = new CakeEmail('queue');
		foreach($reservations as $reservation) {
			$mail->template("closing", "default")
				->emailFormat("text")
				->to($reservation["Seller"]["email"])
				->subject("Bearbeitungsfrist der Artikel für den Flohmarkt endet bald")
				->viewVars(compact("reservation", "event"))
				->send();
		}
		$event["Event"]["closing_sent"] = date("Y-m-d H:i:s");
		$this->Event->save($event);

		return count($reservations);
	}

	public function admin_mail_closed($id) {
		$event = $this->Event->findById($id);
		if ($event["Event"]["closed_sent"] !== null) {
			App::uses('CakeTime', 'Utility');
			$this->Session->setFlash("Die Mail wurde bereits " .
				CakeTime::timeAgoInWords($event["Event"]["closed_sent"], array('format' => 'd.m.Y')) . " versendet.");
		} else {
			$reservations = count($event["Reservation"]);
			$mailCount = $this->sendClosedMails($event);
			$this->Session->setFlash(
				"Es wurden $mailCount Mail(s) verschickt.",
				"default", array('class' => 'success'));
		}
		return $this->redirect(array('action' => 'view', $id));
	}

	private function sendClosedMails($event) {
		$id = $event["Event"]["id"];
		$reservations = $this->Event->Reservation->findAllByEventId($id);
		App::uses('CakeEmail', 'Network/Email');
		$mail = new CakeEmail('queue');
		foreach($reservations as $reservation) {
			$this->Event->Reservation->Seller->Item->label($reservation);
			$mail->template("closed", "default")
				->emailFormat("text")
				->to($reservation["Seller"]["email"])
				->subject("Flohmarkt Vorbereitungen abgeschlossen - Artikel festgelegt")
				->viewVars(compact("reservation", "event"))
				->send();
		}
		$event["Event"]["closed_sent"] = date("Y-m-d H:i:s");
		$this->Event->save($event);

		return count($reservations);
	}

	public function admin_csv($id) {
		$event = $this->Event->findById($id);
		#if (strtotime($event['Event']['reservation_end']) >= time()) {
		#	$this->Session->setFlash("Der Datenexport ist für diese Veranstaltung noch nicht möglich, da die Reserierung noch nicht abgeschlossen ist.");
		#	return $this->redirect(array('action' => 'view', $id));
		#}
		$reservations = $this->Event->Reservation->findAllByEventId($id);
		$this->set("reservations", $reservations);
		$categories = $this->Event->Reservation->Seller->Item->Category->find("list");
		$this->set("categories", $categories);
		$this->response->type('csv');
        $this->layout = 'csv';
	}

	public function admin_sellers_csv($id) {
		$event = $this->Event->findById($id);
		#if (strtotime($event['Event']['reservation_end']) >= time()) {
		#	$this->Session->setFlash("Der Datenexport ist für diese Veranstaltung noch nicht möglich, da die Reserierung noch nicht abgeschlossen ist.");
		#	return $this->redirect(array('action' => 'view', $id));
		#}
		$reservations = $this->Event->Reservation->findAllByEventId($id);
		$this->set("reservations", $reservations);
	}

	public function view($id = null) {
		$this->set('event', $this->Event->findById($id));

		$item = new Item();

		$this->set("item_count", $item->ReservedItem->find("count"));
		$this->set("sold_item_count", $item->ReservedItem->find("count", array("conditions" => array("not" => array("ReservedItem.sold" => null)))));

		$items_per_category = $item->ReservedItem->find("all", array("fields" => array("Category.name", "count(*) as count"),
			"joins" => array(
				array(
					'table' => 'reservations',
        			'alias' => 'Reservation',
        			'type' => 'INNER',
        			'conditions' => array('ReservedItem.reservation_id = Reservation.id', 'Reservation.event_id' => $id)
    			),
				array(
					'table' => 'items',
        			'alias' => 'Item',
        			'type' => 'INNER',
        			'conditions' => array('ReservedItem.item_id = Item.id')
    			),
				array(
					'table' => 'categories',
        			'alias' => 'Category',
        			'type' => 'INNER',
        			'conditions' => array('Category.id = Item.category_id')
    			),
			), "group" => "Category.id", "order" => "count desc"));
		$this->set("items_per_category", $items_per_category);

		$items_per_seller = $item->ReservedItem->find("all", array("fields" => array("Reservation.number", "count(*) as count"),
			"joins" => array(
				array(
					'table' => 'reservations',
        			'alias' => 'Reservation',
        			'type' => 'INNER',
        			'conditions' => array('ReservedItem.reservation_id = Reservation.id', "Reservation.event_id = $id")
    			)
			), "conditions" => array("NOT" => array("ReservedItem.sold" => null)), "group" => "Reservation.number", "order" => "count desc", "limit" => 10));
		$this->set("items_per_seller", $items_per_seller);

		$sum_per_seller = $item->ReservedItem->find("all", array("fields" => array("Reservation.number", "sum(Item.price) as sum"),
			"joins" => array(
				array(
					'table' => 'reservations',
        			'alias' => 'Reservation',
        			'type' => 'INNER',
        			'conditions' => array('ReservedItem.reservation_id = Reservation.id', "Reservation.event_id = $id")
    			),
				array(
					'table' => 'items',
        			'alias' => 'Item',
        			'type' => 'INNER',
        			'conditions' => array('ReservedItem.item_id = Item.id')
    			)
			), "conditions" => array("NOT" => array("ReservedItem.sold" => null)), "group" => "Reservation.number", "order" => "sum desc", "limit" => 10));
		$this->set("sum_per_seller", $sum_per_seller);

		$customer = ClassRegistry::init('Customer');
		$customers_per_city = $customer->find("all", array("fields" => array("ZipCode.city", "count(*) as count"),
			"group" => "ZipCode.city", "order" => "count desc")
		);
		$this->set("customers_per_city", $customers_per_city);
	}
}
