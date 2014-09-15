<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $uses = array();

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

		$events = ClassRegistry::init('Event')->find("all", array('order' => array('Event.date'), 'conditions' => array('Event.date >= now()')));

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
