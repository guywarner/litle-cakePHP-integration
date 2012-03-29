<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<legend><?php echo __('Register Token'); ?></legend>
			<h3><?php echo __('token Function Gist:'); ?></h3>
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
	<?php echo "The fill in info here"?>
	</br>
	</br>
	<?php echo "Please fill out the information to process an register token Request"?>
	</br>
	</br>
	
	<h1><?php echo ('Sample CreditCard Numbers:'); ?></h1>
	
</div>
