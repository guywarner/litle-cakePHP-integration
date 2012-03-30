<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('Sale with Token'); ?></legend>
			<a id="button" style="cursor: pointer"><?php echo __('SDK Implementation'); ?></a>
			<div id="effect" class = "effect" title="SDK Implementation">
				<script src="https://gist.github.com/2243367.js"> </script>
			</div>
	<h3><?php echo __('User Input:'); ?></h3>
	<tr><?php
	
		echo $this->Form->input('amount');
		?></tr>
		<tr><?php
		echo $this->Form->input('name');
		echo $this->Form->input('address1');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		$countries = $this->data['Auth']['countries'];
		echo $this->Form->input('country',array('type'=>'select','options'=>$countries));
		echo $this->Form->input('zip');
		$options = array('VI'=>'VI','MC'=>'MC','AX'=>'AX','DC'=>'DC');
		echo $this->Form->input('type',array('type'=>'select','options'=>$options));
		echo $this->Form->input('expDate');
		echo $this->Form->input('cardValidationNum');
			
	?></tr>
	</fieldset>
	<h3><?php echo __('Additional Values Being Passed:'); ?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><div align="center"><?php echo "Id";?></th>
		<th><div align="center"><?php echo "litleToken";?></th>
	</tr>
	<tr><div align = "center">
		<td><div align = "center"><?php echo $this->data['Auth']['id']; ?>&nbsp;</td></div>
		<td><div align = "center"><?php echo $this->data['Auth']['litleToken']; ?>&nbsp;</td></div>
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
	<h3><?php echo __('About Sale with Token'); ?></h3>
	<?php echo "This transaction allows you to perform a sale using a previously registered token instead of a credit card number"?>
	</br>
	</br>
	<?php echo "Please fill out the information to process a sale"?>
	</br>
	</br>
	
</div>
