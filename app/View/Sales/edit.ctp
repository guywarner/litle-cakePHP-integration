<div class="sales form">
<?php echo $this->Form->create('Sale');?>
	<fieldset>
		<legend><?php echo __('Edit Sale'); ?></legend>
	<?php
		echo $this->Form->input('amount');
		echo $this->Form->input('name');
		echo $this->Form->input('address1');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('country');
		echo $this->Form->input('zip');
		echo $this->Form->input('email');
		echo $this->Form->input('type');
		echo $this->Form->input('number');
		echo $this->Form->input('expDate');
		echo $this->Form->input('cardValidationNum');
		echo $this->Form->input('id');
		echo $this->Form->input('message');
		echo $this->Form->input('response');
		echo $this->Form->input('authMessage');
		echo $this->Form->input('litleTxnId');
		echo $this->Form->input('creditAmount');
		echo $this->Form->input('creditLitleTxnId');
		echo $this->Form->input('creditMessage');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Sale.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Sale.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sales'), array('action' => 'index'));?></li>
	</ul>
</div>
