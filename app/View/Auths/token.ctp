<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('Register Token'); ?></legend>
			<h3><?php echo __('SDK Implementation:'); ?></h3>
			<script src="https://gist.github.com/2243156.js"> </script>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	<h3><?php echo __('User Input:'); ?></h3>
	<tr><?php
		?></tr>
		<tr><?php
		echo $this->Form->input('number');		
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
	<h3><?php echo __('About Token'); ?></h3>
	<?php echo "The register Token transaction allows you to swap a credit card number for a semi-randomized token number"?>
	</br>
	</br>
	<?php echo "Please fill out the information to  register a credit card number"?>
	</br>
	</br>
	
	<h1><?php echo ('Sample CreditCard Numbers:'); ?></h1>
	
</div>
