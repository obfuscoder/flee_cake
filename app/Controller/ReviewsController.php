<?php

App::uses('AppModel', 'Model');

class ReviewsController extends AppController {
	public function admin_index() {
		$this->set("reviews", $this->Review->find("all"));
	}
}

?>