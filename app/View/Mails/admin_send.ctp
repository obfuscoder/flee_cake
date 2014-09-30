<?php $this->set("title_for_layout", "Mails senden") ?>
<script>
var sellers = <?php echo $this->Js->value($sellers); ?>

$(function() {
	$('input[type=checkbox][id^=MailCategory][query]').on('click', function() {
		$('#MailTo option').prop('selected', false);
		var queries = $('input[type=checkbox][id^=MailCategory][query]:checked').map(function() { return $(this).attr('query'); }).get();
		var recipients = [];
		if (queries.length) {
			recipients = sellers;
		}
		queries.forEach(function(query) {
			recipients = $.grep(recipients, function(e) { return eval ("e." + query) });
		});
		$.each(recipients, function(index, e) { $('#MailTo option:contains("'+e.Seller.email+'")').prop('selected', true) });
	});
});

</script>
<?php
	echo $this->Form->create("Mail");
	echo $this->Form->input("subject", array("label" => "Betreff"));
	echo $this->Form->input("body", array("label" => "Inhalt")); ?>
<p>Als Einsprunglink für Verkäufer in Ihren Verwaltungsbereich, bitte <strong>{{login_link}}</strong> benutzen.</p>
<?php
	$recipients = array();
	foreach($sellers as $seller) {
		$recipients[$seller["Seller"]["id"]] = $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] . " <" . $seller["Seller"]["email"] . "> - " . count($seller["Item"]) . " Artikel, " . count($seller["Reservation"]) . " Reservierung(en)";
	}
	echo $this->Form->input("to", array("options" => $recipients, "type" => "select", "label" => "Empfänger", "multiple" => true, "empty" => false, "size" => 10));

	$categories = array(
		1 => array("value" => 1, "name" => "aktiv", "query" => "Seller.active == true"),
		2 => array("value" => 2, "name" => "mit Reservierung", "query" => "Reservation.length > 0"),
		3 => array("value" => 3, "name" => "ohne Reservierung", "query" => "Reservation.length == 0"),
		4 => array("value" => 4, "name" => "mit Artikeln", "query" => "Item.length > 0"),
		5 => array("value" => 5, "name" => "ohne Artikel", "query" => "Item.length == 0"),
	);
	echo $this->Form->input("category", array("type" => "select", "multiple" => "checkbox", "label" => "Kategorien", "empty" => false, "options" => $categories));

	echo $this->Form->end("Senden");
?>
