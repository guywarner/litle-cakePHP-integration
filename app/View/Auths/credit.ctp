<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('CREDIT/REFUND'); ?></legend>
		<a id="button" style="cursor: pointer"><?php echo __('SDK Implementation'); ?></a>
		<div id="effect" class = "effect" title="SDK Implementation">
			<script src="https://gist.github.com/2007013.js"> </script>
		</div>
	<h3><?php echo __('User Input:'); ?></h3>
	<?php
		echo $this->Form->input('creditAmount');
	?>
	</fieldset>
	<h3><?php echo __('Additional Values Being Passed:'); ?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><div align="center"><?php echo "Captured Amount";?></th>
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
	<h3><?php echo __('About Credit'); ?></h3>
	<?php echo "You use a Credit transaction to refund money to a customer, even if the original transaction occurred outside of the Litle & Co. system. You may perform partial credits"?>
	</br>
	</br>
	<?php echo "Please fill out the amount to be credited"?>
	</div>
</div>
	