<?php

App::uses('AppModel', 'Model');

class ReviewsController extends AppController {
	public function admin_index($event_id) {
		$this->set("reviews", $this->Review->findAllByEventId($event_id));
	}
}

?>