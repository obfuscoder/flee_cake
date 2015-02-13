<?php $this->set("title_for_layout", "Bewertungen") ?>
<p>
Anzahl: <?php echo count($reviews) ?>
    <?php print_r($reviews); ?>
</p>
<p>
<?php
    $categories = array(
            "registration" => "Anmeldung / Registrierung",
            "items" => "Verwaltung der Artikel",
            "print" => "Erzeugen und Ausdrucken der Etiketten",
            "reservation" => "Verfahren zur Vergabe der Verkäuferplätze",
            "mailing" => "Informationen per Mail",
            "content" => "Inhalte und Erklärungen auf der Webseite",
            "design" => "Aussehen der Webseite",
            "support" => "Unterstützung bei Problemen",
            "handover" => "Annahme und Rückgabe der Artikel",
            "payoff" => "Abrechnung",
            "sale" => "Verkauf",
            "organization" => "Organisation",
            "total" => "Gesamtnote"
    );
?>
<table class="table table-striped table-bordered table-condensed">
    <tr>
        <td>&nbsp;</td>
        <?php foreach($reviews as $review): ?>
        <th><?php echo
            $this->Html->link($review["Seller"]["id"], array("controller" => "sellers", "action" => "view",
                $review["Seller"]["id"])) ?></th>
        <?php endforeach ?>
        <th>&Oslash;</th>
    </tr>
<?php
    $classes_for_number = array(
        "" => "",
        1 => "success",
        2 => "info",
        3 => "warning",
        4 => "danger",
        5 => "danger"
    );
    foreach($categories as $category => $category_name): ?>
    <tr>
        <th><?php echo $category_name ?></th>
        <?php
            $values = array();
            foreach($reviews as $review) {
                $value = $review["Review"][$category];
                if ($value) array_push($values, $value) ?>
            <td class="<?php echo $classes_for_number[$value] ?>"><?php echo $value ?></td>
        <?php
            }
            $count = count($values);
            if ($count > 0)
                $average = round(array_sum($values) / count($values), 1);
            else
                $average = 0; ?>
        <th class="<?php if($average != 0) echo $classes_for_number[round($average)]?>"><?php if ($average != 0) printf("%.1f", $average) ?></th>
    </tr>
<?php endforeach ?>
</table>
</p>
<h3>Weiterempfehlen</h3>
<?php
    $recommends = $no_recommends = 0;
    foreach ($reviews as $review) {
        if ($review["Review"]["recommend"] == 1) $recommends ++;
        if ($review["Review"]["recommend"] == 0) $no_recommends ++;
    }
    $na_recommends = count($reviews)-$recommends-$no_recommends; ?>
<ul>
    <li><?php echo $recommends ?>x ja (<?php echo sprintf("%d", $recommends/count($reviews)*100) ?> %)</li>
    <li><?php echo $no_recommends ?>x nein (<?php echo sprintf("%d", $no_recommends/count($reviews)*100) ?> %)</li>
    <li><?php echo $na_recommends ?>x unbeantwortet (<?php echo sprintf("%d", $na_recommends/count($reviews)*100) ?> %)</li>
</ul>
<h3>Quelle</h3>
<?php
$sources = array();
foreach ($reviews as $review) {
    $source = $review["Review"]["source"];
    if ($source == null) $source = "[n/a]";
    if (isset($sources[$source]))
        $sources[$source] ++;
    else
        $sources[$source] = 1;
} ?>
<ul>
<?php foreach ($sources as $source => $count): ?>
    <li><?php echo $count ?>x <?php echo $source ?> (<?php echo sprintf("%d", $count/count($reviews)*100) ?> %)</li>
<?php endforeach ?>
</ul>
<h3>Bemerkungen</h3>
<p>
<?php foreach ($reviews as $review): ?>
<?php if ($review["Review"]["to_improve"] == "") continue; ?>
<blockquote>
    <p></p><?php echo $review["Review"]["to_improve"] ?></p>
    <footer><?php echo $review["Seller"]["first_name"] . " " . $review["Seller"]["last_name"] ?></footer>
</blockquote>
<?php endforeach ?>
