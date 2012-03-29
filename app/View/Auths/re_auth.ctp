<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('Re-Authorization'); ?></legend>
	<h3><?php echo __('Re-Auth Function Gist:'); ?></h3>
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
		<th><div align="center"><?php echo "Amount";?></th>
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
	<h3><?php echo __('About Re-Auth'); ?></h3>
	<?php echo "The re-auth transaction performs a second authorization by refrencing the litleTxnId of the original authorization"?>
	</br>
	</br>
	<?php echo "No user fields are needed for a re-auth transaction"?>
	</div>
</div>
	
