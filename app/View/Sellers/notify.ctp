<?php $this->set("title_for_layout", "Sie werden informiert") ?>
<p>Wir werden Sie per eMail informieren, sobald ein Verkäuferplatz frei wird. Diese Information werden alle wartenden Interessenten gleichzeitig erhalten. Auch wie bei der Vergabe der Verkäuferplätze werden die freigewordenen Plätze an diejenigen Interessenten vergeben, die diese als erstes reservieren.</p>
<?php echo $this->Html->link("Zur Eingabe der Artikel", array("controller" => "items", $seller["Seller"]["id"])) ?>
