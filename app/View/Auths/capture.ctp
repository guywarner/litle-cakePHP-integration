<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('CAPTURE'); ?></legend>
	<?php
		echo $this->Form->input('captureAmount');
	?>
	</fieldset>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><div align="center"><?php echo "Id";?></th>
			<th><div align="center"><?php echo "litleTxnId";?></th>
			<th><div align="center"><?php echo "Partial";?></th>
	</tr>
	<tr>
	<td><?php echo h($auth['Auth']['id']); ?>&nbsp;</td>
			<td><?php echo h($auth['litleTxnId']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['amount']); ?>&nbsp;</td>
		</div></td>
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
	<?php echo "Please Fill Out the amount to be Captured"?>
	</div>
</div>
