<?php
    $this->set("title_for_layout", "Termin bearbeiten");
    define('THREE_YEARS', 3600 * 24 * 365 * 3);
	echo $this->Form->create('Event');
	echo $this->Form->input('id');
	echo $this->Form->input('name');
    echo $this->Form->radio('type', array("commission" => "Kommissionsflohmarkt", "standalone" => "Tischflohmarkt"));
	echo $this->Form->input('details', array("type" => "textarea"));
    echo $this->Form->date('date', array("maxYear" => date("Y") + 3, "minYear" => date("Y")));
	echo $this->Form->checkbox('date_confirmed');
?>
<div class="row">
<?php
	echo $this->Form->input('max_sellers', array("div" => array("class" => "form-group col-sm-3")));
	echo $this->Form->input('max_items_per_seller', array("div" => array("class" => "form-group col-sm-3 commission")));
?>
</div>
<div class="row">
<?php
	echo $this->Form->time('start_time', array("div" => array("class" => "form-group col-sm-3")));
	echo $this->Form->time('end_time', array("div" => array("class" => "form-group col-sm-3")));
?>
</div>
<?php	
	echo $this->Form->date_time('reservation_start', array("maxYear" => date("Y") + 3, "minYear" => date("Y")));
	echo $this->Form->date_time('reservation_end', array("maxYear" => date("Y") + 3, "minYear" => date("Y")));
?>
<div class="commission">
<?php
	echo $this->Form->date('item_handover_date', array("maxYear" => date("Y") + 3, "minYear" => date("Y")));
?>
</div>
<div class="row commission">
<?php
	echo $this->Form->time('item_handover_start_time', array("div" => array("class" => "form-group col-sm-3")));
	echo $this->Form->time('item_handover_end_time', array("div" => array("class" => "form-group col-sm-3")));
?>
</div>
<div class="commission">
<?php	
	echo $this->Form->date('item_pickup_date', array("maxYear" => date("Y") + 3, "minYear" => date("Y")));
?>
</div>
<div class="row commission">
<?php
	echo $this->Form->time('item_pickup_start_time', array("div" => array("class" => "form-group col-sm-3")));
	echo $this->Form->time('item_pickup_end_time', array("div" => array("class" => "form-group col-sm-3")));
?>
</div>
<?php
	echo $this->Form->end("Speichern");
?>

<script>
    show_inputs_based_on_type = function() {
        var is_commission_type = false;
        var selected_option = $("input[type='radio'][name='data[Event][type]']:checked");
        if (selected_option.length > 0) {
            if (selected_option.val() == "commission") {
                is_commission_type = true;
            }
        }
        if (is_commission_type) {
            $(".commission").show();
        } else {
            $(".commission").hide();
        }
    }
    $("input[type='radio'][name='data[Event][type]']").change(show_inputs_based_on_type);
    $(show_inputs_based_on_type);
</script>