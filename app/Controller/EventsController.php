<?php
App::uses('AppController', 'Controller');

class EventsController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$this->Event->recursive = 0;
		$this->set('events', $this->Paginator->paginate());
	}

	public function view($id = null) {
		$this->set('event', $this->Event->findById($id));
		$this->set('reservations', $this->Event->Reservation->findAllByEventId($id));
	}

	public function add() {
		if ($this->request->isPost()) {
			$this->Event->create();
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash("Das Ereignis wurde erfolgreich hinzugefügt.", "default", array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash("Das Ereignis konnte nicht gespeichert werden.");
		}
	}

	public function edit($id = null) {
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

	public function delete($id = null) {
		$this->Event->id = $id;
		$this->request->onlyAllow('post', 'delete');
		if ($this->Event->delete($id)) {
			$this->Session->setFlash("Ereignis gelöscht.", "default", array('class' => 'success'));
		} else {
			$this->Session->setFlash("Ereignis konnte nicht gelöscht werden.");
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function invite($id) {
		$event = $this->Event->findById($id);
		$reservations = count($event["Reservation"]);
		$unreservedSellers = $this->Event->Reservation->Seller->findAllUnreserved($id);
		$invitationCount = count($unreservedSellers);
		$this->Session->setFlash(
			"Es wurden $invitationCount Einladung(en) verschickt. Es gibt bereits $reservations Reservierung(en).",
			"default", array('class' => 'success'));
		return $this->redirect(array('action' => 'view', $id));
	}
}
