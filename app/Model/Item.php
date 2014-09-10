<?php

class Item extends AppModel {
	public $belongsTo = array("Seller", "Category");
	public $hasAndBelongsToMany = array("Reservation" => array("with" => "ReservedItem", "unique" => "keepExisting", "order" => "ReservedItem.number"));

	public $validate = array(
		"description" => array("rule" => array("between", "4", "30"), "message" => "Bitte geben Sie eine sinnvolle Beschreibung mit 4 bis 30 Buchstaben ein."),
		"price" => array(
			"notempty" => array("rule" => "notEmpty", "message" => "Bitte geben Sie einen Preis ein."),
			"number" => array("rule" => "/^\d{1,3}(?:.\d(?:0)?)?$/", "message" => "Der Preis muss zwischen 0 und 1000 € liegen und auf 10 Cent genau sein."),
			"minmax" => array("rule" => array("range", 0.1, 999.9), "message" => "Der Preis muss zwischen 0 und 1000 € liegen und auf 10 Cent genau sein.")
		),
		"category_id" => array(
            "notempty" => array("rule" => "notempty", "message" => "Bitte wählen Sie eine Kategorie."),
            // TODO extract rule into a more generic CategoryLimitPerSeller model
            "nomoreshoes" => array(
                "rule" => array("limitedItemsForCategory", 1, 3),
                "message" => "Leider können wir aus Platzgründen nicht mehr als 3 Paar Schuhe pro Verkäufer annehmen. Sie haben bereits so viel Artikel dieser Kategorie eingegeben."
            )
        )
	);

    public function limitedItemsForCategory($check, $limitedCategoryId, $limit) {
        if ($check["category_id"] != $limitedCategoryId) return true;
        $currentCount = $this->find("count", array(
            "conditions" => array(
                "seller_id" => $this->data["Item"]["seller_id"], "category_id" => $limitedCategoryId,
                "NOT" => array("id" => $this->data["Item"]["id"])
            ),
            "recursive" => -1
        ));
        return $currentCount < $limit;
    }

	public function getNextReservedItemNumber($reservationId) {
		$result = $this->ReservedItem->find("first", array(
			"conditions" => array("reservation_id" => $reservationId),
			"fields" => array("max(ReservedItem.number) as max_number")
		));
		$max = $result[0]["max_number"];
		return ($max === null) ? 1 : $max+1;
	}

	// http://en.wikipedia.org/wiki/Luhn_algorithm
	public function getChecksum($number) {
		$digits = strrev($number);
		$checksum = 0;
		for ($i=0; $i<strlen($digits); $i++) {
			$digit = $digits[$i] * (($i+1)%2+1);
			$sum = array_sum(str_split($digit));
			$checksum += $sum;
		}
		return $checksum % 10;
	}

	public function getCode($eventNumber, $sellerNumber, $itemNumber) {
		$number = sprintf("%02d%03d%02d", $eventNumber, $sellerNumber, $itemNumber);
		return $number . $this->getChecksum($number);
	}

	public function getItemCountForReservations() {
		$result = $this->query("select count(*) as count from items as Item where seller_id in (select seller_id from reservations)");
		return $result[0][0]["count"];
	}

	public function label($reservation) {
		$reservationId = $reservation["Reservation"]["id"];
        $reservedItemIds = array();
        foreach ($reservation["Item"] as $item) {
        	array_push($reservedItemIds, $item["id"]);
        }
        $reservedItemNumber = $this->getNextReservedItemNumber($reservation["Reservation"]["id"]);
        $unreservedItemIds = $this->find('list', array("fields" => array("id"), "conditions" => array("Item.seller_id" => $reservation["Seller"]["id"], "NOT" => array("Item.id" => $reservedItemIds))));
        $itemsToReserve = array();
        foreach ($unreservedItemIds as $itemId) {
        	array_push($itemsToReserve, array(
        		"ReservedItem" => array(
		        	"item_id" => $itemId,
        			"reservation_id" => $reservationId,
        			"number" => $reservedItemNumber,
        			"code" => $this->getCode($reservation["Event"]["id"], $reservation["Reservation"]["number"], $reservedItemNumber)
        		)
        	));
        	$reservedItemNumber++;
		}
		if ($itemsToReserve) {
			$this->ReservedItem->create();
			$this->ReservedItem->saveAll($itemsToReserve);
		}
		return count($itemsToReserve);
	}
}

?>