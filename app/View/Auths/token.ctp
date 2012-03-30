<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<h3><?php echo __('Register Token'); ?></h3>
		<a id="button" style="cursor: pointer"><?php echo __('SDK Implementation'); ?></a>
		<div id="effect" class = "effect" title="SDK Implementation">
			<script src="https://gist.github.com/2243156.js"> </script>
		</div>
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
	<?php echo "Please fill out the information to  register a credit card number."?>
	</br>
	</br>
	<?php echo "You may click on the SDK Implementation link to view token implementation."?>
	</br>
	</br>
	<h3><?php echo ('Sample CreditCards:'); ?></h3>
	<table class="center" style="font-size:10pt">
	<tr><th colspan=2><h4>Sucessful</h4></th></tr>
	<tr><td>4457119922390123</td><td>Approved</td></tr>
	<tr><td>4445000011111801</td><td>Approved</td></tr>
	<tr><td>4475000011231801</td><td>Approved</td></tr>
	<tr><td>5475088011231801</td><td>Approved</td></tr>
	</table>
</div>