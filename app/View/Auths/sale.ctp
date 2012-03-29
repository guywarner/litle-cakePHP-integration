<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('Sale'); ?></legend>
			<h3><?php echo __('SDK Implementation:'); ?></h3>
			<script src="https://gist.github.com/2007219.js"> </script>
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
		echo $this->Form->input('number');
		echo $this->Form->input('expDate');
		echo $this->Form->input('cardValidationNum');
			
	?></tr>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Back to Homepage'), array('action' => 'index'));?></li>
	</ul>
	</br>
	<h3><?php echo __('About Sale'); ?></h3>
	<?php echo "The Sale transaction enables you to both authorize fund availability and deposit those funds by means of a single transaction. The Sale transaction is also known as a conditional deposit, because the deposit takes place only if the authorization succeeds. If the authorization is declined, the deposit will not be processed."?>
	</br>
	</br>
	<?php echo "Please fill out the information to process an sale"?>
	</br>
	</br>
	
	<h1><?php echo ('Sample CreditCard Numbers:'); ?></h1>
	
</div>
