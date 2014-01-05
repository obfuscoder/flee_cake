<?php
	echo "Kundennr;Vorname Name;Straße Hausnr;plz Ort;tel;email\r\n";
	foreach ($reservations as $reservation) {
		printf("%s;%s %s;%s;%s %s;%s;%s\r\n",
			$reservation["Reservation"]["number"],
			preg_replace("/;/", ":", $reservation["Seller"]["first_name"]),
			preg_replace("/;/", ":", $reservation["Seller"]["last_name"]),
			preg_replace("/;/", ":", $reservation["Seller"]["street"]),
			preg_replace("/;/", ":", $reservation["Seller"]["zip_code"]),
			preg_replace("/;/", ":", $reservation["Seller"]["city"]),
			preg_replace("/;/", ":", $reservation["Seller"]["phone"]),
			preg_replace("/;/", ":", $reservation["Seller"]["email"])
		);
	}
?>
