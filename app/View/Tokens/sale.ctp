<div class="Sale form">
<?php echo $this->Form->create('Token');?>
	<fieldset>
		<legend><?php echo __('Sale Transaction Using Previously Registered Token'); ?></legend>
	<?php
		echo $this->Form->input('saleAmount');
		echo $this->Form->input('name');
		echo $this->Form->input('address1');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('country');
		echo $this->Form->input('zip');
		echo $this->Form->input('email');
		echo $this->Form->input('type');
		echo $this->Form->input('cardValidationNum');
		echo $this->Form->input('expDate');
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
