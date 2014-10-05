<?php $this->set("title_for_layout", "Reservierung") ?>
<p>Bitte wählen Sie aus den noch verfügbaren Plätzen einen aus:</p>
<?php
    echo $this->Form->create("Reservation");
    echo $this->Form->input("number", array("options" => $available_numbers));
    echo $this->Form->end("Reservieren");
?>
