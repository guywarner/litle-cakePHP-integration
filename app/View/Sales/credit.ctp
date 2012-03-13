<div class="sales form">
<?php echo $this->Form->create('Sale');?>
	<fieldset>
		<legend><?php echo __('CREDIT'); ?></legend>
	<?php
		echo $this->Form->input('creditAmount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sales'), array('action' => 'index'));?></li>
	</ul>
</div>
