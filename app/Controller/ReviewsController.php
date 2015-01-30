<?php

App::uses('AppModel', 'Model');

class ReviewsController extends AppController {
	public function admin_index($event_id) {
		$this->set("reviews", $this->Review->findAllByEventId($event_id));
	}

	public function review($event_id) {
		$seller = $this->sellerFromSession();
		if ($this->Review->findBySellerIdAndEventId($seller["Seller"]["id"], $event_id)) {
			return $this->render("done");
		}
		if ($this->request->isPost()) {
			$this->request->data["Review"]["seller_id"] = $seller["Seller"]["id"];
			$this->request->data["Review"]["event_id"] = $event_id;
			$this->Review->create();
			$this->Review->save($this->request->data);
			return $this->render("done");
		}
	}
}

?>