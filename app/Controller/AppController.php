<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

Configure::write('Config.language', 'deu');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers = array("Form" => array("className" => "MyForm"), "Html" => array("className" => "MyHtml"), "Time");
    
    function beforeFilter () {
    	if ($this->request->url == "admin") {
    		return;
    	}
        if (isset($this->params["admin"]) && $this->params["admin"]) {
            if (!$this->Session->read("Admin")) {
            	return $this->redirect("/pages/unauthorized");
            }
        }
    }

    protected function sellerFromSession() {
        if ($this->Session->valid() && $this->Session->check("Seller")) {
            $seller = $this->Session->read("Seller");
            $this->loadModel('Seller');
            return $this->Seller->findById($seller['Seller']['id']);
        } else {
            return $this->redirect(array("controller" => "pages", "action" => "session_expired"));
        }
    }

}
