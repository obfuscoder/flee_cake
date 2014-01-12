<?php

class MailsController extends AppController {
	public $components = array("Session");

	public function worker() {
		$unsentMails = $this->Mail->findAllBySent(null);
		$maxi = min(100,count($unsentMails));
		for($i=0; $i<$maxi; $i++) {
			$this->Mail->send($unsentMails[$i]);
		}
		$this->set("sent", $maxi);
		$this->set("rest", count($unsentMails)-$maxi);

		$this->response->type('plain');
        $this->layout = 'plain';
	}
}

?>