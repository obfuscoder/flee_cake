<?php
	echo "Artnr;Kategorie;Bezeichnung;Groesse;Preis\r\n";
	foreach ($reservations as $reservation) {
		foreach ($reservation["Item"] as $item) {
			printf("%s;%s;%s;%s;%.2f\r\n",
				$item["ReservedItem"]["code"],
				$categories[$item["category_id"]],
				preg_replace("/;/", ":", $item["description"]),
				preg_replace("/;/", ":", $item["size"]),
				$item["price"]);
		}
	}
?>
