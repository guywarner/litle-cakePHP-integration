<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('CAPTURE'); ?></legend>
	<h3><?php echo __('Capture Function Gist:'); ?></h3>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	<h3><?php echo __('User Input:'); ?></h3>
	<?php
		echo $this->Form->input('captureAmount');
	?>
	<?php echo $this->Form->checkbox('partial');echo 'partial capture?'; ?>
	</fieldset>
	<h3><?php echo __('Additional Values Being Passed:'); ?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><div align="center"><?php echo "Authorized Amount";?></th>
		<th><div align="center"><?php echo "Id";?></th>
		<th><div align="center"><?php echo "litleTxnId";?></th>
	</tr>
	<tr><div align = "center">
		<td><div align = "center"><?php echo $this->data['Auth']['amount']; ?>&nbsp;</td></div>
		<td><div align = "center"><?php echo $this->data['Auth']['id']; ?>&nbsp;</td></div>
		<td><div align = "center"><?php echo $this->data['Auth']['litleTxnId']; ?>&nbsp;</td></div>
	</tr>
	</table>
<?php echo $this->Form->end(__('Submit'));?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back to Homepage'), array('action' => 'index'));?></li>
	</ul>
	</br>
	<h3><?php echo __('About Capture'); ?></h3>
	<?php echo "You use a Capture transaction to transfer previously authorized funds from the customer to you after order fulfillment. You can submit a Capture transaction for the full amount of the Authorization, or for a lesser amount by setting the partial attribute to true. "?>
	</br>
	</br>
	<?php echo "Please Fill Out the amount to be Captured and check the box for a partial capture"?>
	</div>
</div>
