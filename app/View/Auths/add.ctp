<h1> <?php echo $this->Html->image('Litle.jpg');?></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('Authorization'); ?></legend>
			<h3><?php echo __('Auth Function Gist:'); ?></h3>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	<h3><?php echo __('User Input:'); ?></h3>
	<tr><?php
	
		echo $this->Form->input('amount');
		?></tr>
		<tr><?php
		echo $this->Form->input('name');
		echo $this->Form->input('address1');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
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
	<h3><?php echo __('About Authorization'); ?></h3>
	<?php echo "The Authorization transaction enables you to confirm that a customer has submitted a valid payment method with their order and has sufficient funds to purchase the goods or services they ordered."?>
	</br>
	</br>
	<?php echo "Please fill out the information to process an authorization"?>
	</br>
	</br>
	
	<h1><?php echo ('Sample CreditCard Numbers:'); ?></h1>
	
</div>
