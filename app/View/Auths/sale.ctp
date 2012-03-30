<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<h3><?php echo __('Sale'); ?></h3>
		<a id="button" style="cursor: pointer"><?php echo __('SDK Implementation'); ?></a>
		<div id="effect" class = "effect" title="SDK Implementation">
			<script src="https://gist.github.com/2007219.js"> </script>
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
	<h3><?php echo ('Sample CreditCards:'); ?></h3>
	<table class="center" style="font-size:10pt">
	<tr><th colspan=2><h4>Sucessful</h4></th></tr>
	<tr><td>VI 4457010000000009</td><td>Approved</td></tr>
	<tr><td>MC 5112010000000003</td><td>Approved</td></tr>
	<tr><td>DI 6011010000000003</td><td>Approved</td></tr>
	<tr><td>AX 375001000000005</td><td>Approved</td></tr>
	<tr><td>VI 4457010200000007</td><td>Approved</td></tr>
	</table>
	<table class="center" style="font-size:10pt">
	<tr><th colspan=2><h4>Unsucessful</h4></th></tr>
	<tr><td align="center">VI 4457010100000008</td><td align="center">Insufficient Funds</td></tr>
	<tr><td>MC 5112010100000002</td><td>Invalid Account Number</td></tr>
	<tr><td>DI 6011010100000002</td><td>Call Discover</td></tr>
	<tr><td>AX 375001010000003</td><td>Pick up Card</td></tr>
	</table>
</div>

