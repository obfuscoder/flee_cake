<?php

App::uses('AppModel', 'Model');

class ReviewsController extends AppController {
	public function admin_index() {
		$result = $this->Review->find("all", array("fields" => array(
			"avg(registration) as Registrierung",
			"avg(items) as Artikeleingabe",
			"avg(print) as Etikettendruck",
			"avg(reservation) as Reservierung",
			"avg(mailing) as 'Mails und Informationen'",
			"avg(content) as Webseiteninhalte",
			"avg(design) as Webgestaltung",
			"avg(support) as Hilfestellung",
			"avg(handover) as Übergabe",
			"avg(payoff) as Abrechnung",
			"avg(sale) as Verkauf",
			"avg(organization) as 'allgemeine Organisation'",
			"avg(total) as Gesamt",
		)));
		$reviews = $result[0][0];
		$this->set("reviews", $reviews);
		$this->set("review_count", $this->Review->find("count"));
		$this->set("comments", $this->Review->find("list", array("fields" => array("to_improve"), "conditions" => array("NOT" => array("to_improve" => "")))));
	}
}

?>