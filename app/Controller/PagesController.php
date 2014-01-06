<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
	public $helpers = array("Html", "Form", "Session", "Time");

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array();

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 * @throws NotFoundException When the view file could not be found
	 *	or MissingViewException in debug mode.
	 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		$events = ClassRegistry::init('Event')->find("all", array('order' => array('Event.date')));

		if ($page == "home") {
			App::uses('CakeTime', 'Utility');
			$exact_date_format = "%A, %e. %B %Y";
			$time_format = "%H:%M";
			$vague_date_format = "vorraussichtlich im %B %Y";
			foreach ($events as &$event) {
				if ($event["Event"]["date_confirmed"]) {
					$event["Event"]["date_string"] = sprintf ("am %s von %s bis %s Uhr",
						CakeTime::format($event["Event"]["date"], $exact_date_format),
						CakeTime::format($event["Event"]["start_time"], $time_format),
						CakeTime::format($event["Event"]["end_time"], $time_format));
					$event["Event"]["reservation_start_string"] = 
						CakeTime::format($event["Event"]["reservation_start"], "am $exact_date_format um $time_format Uhr");
					$event["Event"]["item_handover_date_string"] = sprintf ("am %s von %s bis %s Uhr",
						CakeTime::format($event["Event"]["item_handover_date"], $exact_date_format),
						CakeTime::format($event["Event"]["item_handover_start_time"], $time_format),
						CakeTime::format($event["Event"]["item_handover_end_time"], $time_format));
					$event["Event"]["item_pickup_date_string"] = sprintf ("am %s von %s bis %s Uhr",
						CakeTime::format($event["Event"]["item_pickup_date"], $exact_date_format),
						CakeTime::format($event["Event"]["item_pickup_start_time"], $time_format),
						CakeTime::format($event["Event"]["item_pickup_end_time"], $time_format));
				} else {
					$event["Event"]["date_string"] = CakeTime::format($event["Event"]["date"], $vague_date_format);
				}
			}
			$this->set("events", $events);
		}
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
