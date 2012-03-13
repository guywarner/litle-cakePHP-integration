<div class="credit form">
<?php echo $this->Form->create('Token');?>
	<fieldset>
		<legend><?php echo __('Refund Previous Transaction'); ?></legend>
	<?php
		echo $this->Form->input('creditAmount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Register Token Requests'), array('action' => 'index'));?></li>
	</ul>
</div>
