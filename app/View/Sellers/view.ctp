<?php $this->set("title_for_layout", "Verkäufer-Bereich") ?>
<p>Von hier aus können Sie Ihre Stammdaten und Artikel verwalten. Sollten Sie keine weitere eMail-Benachrichtigung erhalten oder Ihre Daten löschen wollen, können Sie dies in der Stammdatenbearbeitung durchführen.</p>
<h3>Reservierungen</h3>
<?php if ($reservation): ?>
    <p>Sie haben die Reservierungsnummer <strong><?php echo $reservation["Reservation"]["number"] ?></strong>.
    <?php if (strtotime($event["Event"]["reservation_end"]) > time()): ?>
        Alle zu verkaufenden Artikel müssen bis zum <?php echo $this->Time->format($event["Event"]["reservation_end"], "%A, %e. %B %Y um %H:%M Uhr") ?> eingetragen und die Etiketten erzeugt sein.
        <?php if (strtotime($event["Event"]["reservation_end"]) > time()): ?>
            </p><p><strong>Reservierung rückgängig machen:</strong> Sollten Sie nicht mehr als Verkäufer am Flohmarkt teilnehmen können, bitte
            <?php echo $this->Html->link("geben Sie Ihre Reservierung wieder frei",
                    array("controller" => "reservations", "action" => "delete", $reservation["Reservation"]['id']),
                    array(),
                    "Sind Sie sicher, dass Sie die Reservierung freigeben möchten? Sie können damit nicht mehr als Verkäufer an diesem Flohmarkt teilnehmen.") ?>.
        <?php endif ?>
    <?php else: ?>
        Die Frist zum Erzeugen der Etiketten für den Flohmarkt ist abgelaufen. Sie können keine weiteren Etiketten erzeugen. Sie können jedoch die bereits erzeugten Etiketten ausdrucken.
    <?php endif ?>
    </p>
<?php else: ?>
    <p>Sie haben noch keine Reservierungsnummer. <strong>Ein Verkauf ist nur mit Reservierungsnummer möglich</strong>.</p>
    <p>
    <?php if ($event["Event"]["max_sellers"] <= count($event["Reservation"])): ?>
        Leider sind alle Plätze bereits vergeben.
        <?php if ($seller["Seller"]["notify"]): ?>
            Sie stehen auf der Warteliste und bekommen eine Email sobald ein Platz frei wird.
        <?php else: ?>
            <?php echo $this->Form->postLink("Hier", array("controller" => "sellers", "action" => "notify")) ?> können Sie sich auf die Warteliste setzen lassen. Sie erhalten eine Mail sobald ein Platz frei wird.
        <?php endif; ?>
    <?php else: ?>
        <?php if (strtotime($event["Event"]["reservation_start"]) > time()): ?>
            Sie können sich ab <?php echo $this->Time->format($event["Event"]["reservation_start"], "%A, %e. %B %Y um %H:%M Uhr") ?> einen Verkäuferplatz reservieren.
        <?php endif; ?>
        <?php if (strtotime($event["Event"]["reservation_start"]) < time() && strtotime($event["Event"]["reservation_end"]) > time()): ?>
            Sie können sich <?php echo $this->Html->link("hier", array("controller" => "sellers", "action" => "reservation", $seller["Seller"]['token'], $event["Event"]["id"])) ?> einen Verkäuferplatz reservieren.
        <?php endif; ?>
    <?php endif; ?>
    </p>
<?php endif ?>
<h3>Artikel</h3>
<p>Sie haben bisher <?php echo count($seller["Item"]) ?> Artikel angelegt.</p>
<?php echo $this->Html->iconLink("list", "Artikel bearbeiten", array("controller" => "items")); ?>
<h3>Ihre Stammdaten</h3>
<p><strong><?php echo $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] ?></strong><br/>
<?php echo $seller["Seller"]["street"] ?><br/>
<?php echo $seller["Seller"]["zip_code"] . " " . $seller["Seller"]["city"] ?></br></p>
<p>Tel.: <?php echo $seller["Seller"]["phone"] ?><br/>
Mail: <a href="mailto:<?php echo $seller["Seller"]["email"] ?>"><?php echo $seller["Seller"]["email"] ?></a></p>
<?php echo $this->Html->iconLink("user", "Stammdaten bearbeiten", array("action" => "edit")); ?>
