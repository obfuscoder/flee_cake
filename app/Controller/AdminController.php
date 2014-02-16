<?php

App::uses('Mail', 'Model');
App::uses('Seller', 'Model');
App::uses('Item', 'Model');

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

		$mail = new Mail();
		$sent_mails = $mail->find("count", array("conditions" => array("sent !=" => null)));
		$unsent_mails = $mail->find("count", array("conditions" => array("sent" => null)));
		$last_sent_mail = $mail->find("first", array("conditions" => array("sent is not null"), "order" => array("sent" => "desc")));
		$this->set("sent_mails", $sent_mails);
		$this->set("unsent_mails", $unsent_mails);
		$this->set("last_sent_mail", $last_sent_mail ? $last_sent_mail["Mail"]["sent"] : "");

		$seller = new Seller();
		$seller_count = $seller->find("count");
		$this->set("seller_count", $seller_count);

		$active_seller_count = $seller->find("count", array("conditions" => array("active" => true)));
		$this->set("active_seller_count", $active_seller_count);

		$waiting_seller_count = $seller->find("count", array("conditions" => array("notify" => true)));
		$this->set("waiting_seller_count", $waiting_seller_count);

		$item = new Item();
		$item_count = $item->find("count");
		$this->set("item_count", $item_count);

		$reservation = new Reservation();
		$reserved_item_count = $reservation->ReservedItem->find("count");
		$this->set("reserved_item_count", $reserved_item_count);

		$item_count_for_reservations = $item->getItemCountForReservations();
		$this->set("item_count_for_reservations", $item_count_for_reservations);

		$items_per_category = $item->find("all", array("fields" => array("Category.name", "count(*) as count"), "group" => "Category.id"));
		$this->set("items_per_category", $items_per_category);

		$items_per_seller = $item->ReservedItem->find("all", array("fields" => array("Reservation.number", "count(*) as count"),
			"joins" => array(
				array(
					'table' => 'reservations',
        			'alias' => 'Reservation',
        			'type' => 'INNER',
        			'conditions' => array('ReservedItem.reservation_id = Reservation.id')
    			)
			), "conditions" => array("NOT" => array("ReservedItem.sold" => null)), "group" => "Reservation.number", "order" => "count desc", "limit" => 10));
		$this->set("items_per_seller", $items_per_seller);

		$totals_per_seller = $item->ReservedItem->find("all", array("fields" => array("Reservation.number", "sum(Item.price) as total"),
			"joins" => array(
				array(
					'table' => 'reservations',
        			'alias' => 'Reservation',
        			'type' => 'INNER',
        			'conditions' => array('ReservedItem.reservation_id = Reservation.id')
    			),
				array(
					'table' => 'items',
        			'alias' => 'Item',
        			'type' => 'INNER',
        			'conditions' => array('ReservedItem.item_id = Item.id')
    			)
			), "conditions" => array("NOT" => array("ReservedItem.sold" => null)), "group" => "Reservation.number", "order" => "total desc", "limit" => 10));
		$this->set("totals_per_seller", $totals_per_seller);

		$items_per_day = $item->find("all", array("fields" => array("date(Item.created) as date", "count(*) as count"),
			"group" => "date(Item.created)", 'recursive' => 0));
		$this->set("items_per_day", $items_per_day);

		$review = new Review();
		$review_count = $review->find("count");
		$this->set("review_count", $review_count);
	}

	public function admin_dump() {
		$date = strftime("%Y%m%d%H%M%S");
		header("Content-Disposition: attachment; filename=\"database_dump_$date.sql.gz\"");
		$this->response->type('gz');
        $this->layout = 'plain';
        $db = new DATABASE_CONFIG();
		$db_config = $db->default;
		passthru("mysqldump --user=" . $db_config["login"] . " --password=" . $db_config["password"] . " --host=" . $db_config["host"] . " " . $db_config["database"] . " | gzip");
	}
}

?>