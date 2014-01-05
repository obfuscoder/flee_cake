<?php

class AdminController extends AppController {
	public $components = array(
		'Session', 'RequestHandler', "Auth" => array(
			'authenticate' => array(
				'Basic' => array(
					'fields' => array('username' => 'login')
        		)
        	)
		)
	);

	public function admin_index() {
		$this->Session->write("Admin", true);
	}
}

?>