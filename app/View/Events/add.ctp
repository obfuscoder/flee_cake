<div class="events form">
<?php echo $this->Form->create('Event'); ?>
	<fieldset>
		<legend><?php echo __('Add Event'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('date');
		echo $this->Form->input('max_sellers');
		echo $this->Form->input('max_items_per_seller');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
		echo $this->Form->input('reservation_start');
		echo $this->Form->input('reservation_end');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?></li>
	</ul>
</div>
