<?php $this->set("title_for_layout", "Verkäufer-Bereich") ?>
<p>Von hier aus können Sie Ihre Stammdaten und Artikel verwalten. Sollten Sie keine weitere eMail-Benachrichtigung erhalten oder Ihre Daten löschen wollen, können Sie dies in der Stammdatenbearbeitung durchführen.</p>
<h3>Ihre Stammdaten</h3>
<p><strong><?php echo $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] ?></strong><br/>
<?php echo $seller["Seller"]["street"] ?><br/>
<?php echo $seller["Seller"]["zip_code"] . " " . $seller["Seller"]["city"] ?></br></p>
<p>Tel.: <?php echo $seller["Seller"]["phone"] ?><br/>
Mail: <a href="mailto:<?php echo $seller["Seller"]["email"] ?>"><?php echo $seller["Seller"]["email"] ?></a></p>
<?php echo $this->Html->iconLink("user", "Stammdaten bearbeiten", array("action" => "edit")); ?>
<h3>Artikel</h3>
<p>Sie haben bisher <?php echo count($seller["Item"]) ?> Artikel angelegt.</p>
<?php echo $this->Html->iconLink("list", "Artikel bearbeiten", array("controller" => "items")); ?>
