<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('VOID'); ?></legend>
	<h3><?php echo __('Void Function Gist:'); ?></h3>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</fieldset>
	<h3><?php echo __('Additional Values Being Passed:'); ?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><div align="center"><?php echo "Transaction to be Voided";?></th>
		<th><div align="center"><?php echo "Amount";?></th>
		<th><div align="center"><?php echo "Id";?></th>
		<th><div align="center"><?php echo "litleTxnId";?></th>
	</tr>
	<tr><div align = "center">
		<td><div align = "center"><?php echo "credit or caprture"?>&nbsp;</td></div>
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
	<h3><?php echo __('About Void'); ?></h3>
	<?php echo "The Void transaction enables you to cancel any settlement transaction as long as the transaction has not yet settled and the original transaction occurred within the Litle system (Voids require a reference to a litleTxnId)."?>
	</br>
	</br>
	<?php echo "No user fields are needed for a void transaction"?>
	</div>
</div>
	
