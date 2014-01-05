<?php $this->set("title_for_layout", "Reservierung nicht möglich") ?>
<p>Leider sind alle Verkäuferplätze bereits reserviert.</p>
<p>Sie haben jedoch die Möglichkeit, sich in die Warteliste einzutragen. Sobald für Sie ein Verkäuferplatz frei geworden ist, werden wir Sie per Mail informieren. Der Platz wird dann für 24 Stunden für Sie reserviert sein, bis der nächste in der Warteliste diesen Platz angeboten bekommt.</p>
<p class="actions"><?php echo $this->Html->link("In Warteliste eintragen", array("action" => "queue", $seller["Seller"]["id"], $event["Event"]["id"])) ?></p>
