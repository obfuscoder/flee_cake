<?php $this->set("title_for_layout", "Reservierung") ?>
<h3><?php echo $event["Event"]["name"]; ?></h3>
<p><strong>am <?php
echo $this->Time->format($event["Event"]["date"], "%A, %e. %B %Y")
?> von <?php
echo $this->Time->format($event["Event"]["start_time"], "%H:%M")
?> bis <?php
echo $this->Time->format($event["Event"]["end_time"], "%H:%M")
?> Uhr</strong></p>
<p>Bitte wählen Sie aus den noch verfügbaren Plätzen einen aus:</p>
<?php
    echo $this->Form->create("Reservation");
    echo $this->Form->input("number", array("options" => $available_numbers));
    echo $this->Form->end("Reservieren");
?>
