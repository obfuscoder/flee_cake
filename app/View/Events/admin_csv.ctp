<?php
	echo "Artnr;Kategorie;Bezeichnung;Groesse;Preis\r\n";
	foreach ($reservations as $reservation) {
		foreach ($reservation["Item"] as $item) {
			printf("%s;%s;%s;%s;%.2f\r\n",
				$item["ReservedItem"]["code"],
				$item["category_id"],
				$item["description"],
				$item["size"],
				$item["price"]);
		}
	}
?>
