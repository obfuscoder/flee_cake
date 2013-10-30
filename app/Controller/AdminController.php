<?php

class AdminController extends AppController {
	public $components = array('Session', 'RequestHandler', "Auth" => array(
		"authenticate" => array("Digest" => array('fields' => array('username' => 'email'), "passwordHasher" => array()))
	));

	public function admin_index() {
		$this->Session->write("Admin", true);
	}
}

?>