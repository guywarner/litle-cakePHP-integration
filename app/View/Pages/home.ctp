<?php?>
<h1> <?php echo $this->Html->image('Litle.jpg');?></h1>

	<fieldset>
		<legend align="center";><?php echo __('Welcome to the Litle & Co. Cake PHP demo App'); ?></legend>
	<?php echo "The following code is an example of using the Litle & Co. Cake php plugin";?>
	</fieldset>
<?php ?>


<div class="actions">
	<h3><?php echo __('Transactions'); ?></h3>
	<ul>
	</br>
		<li><?php echo $this->Html->link(__('Register Token Requests'),'/tokens');?></li>
	</ul>
</div>

<div class="actions">
	<ul>
	</br>
	</br>
	</br>
	<li><?php echo $this->Html->link(__('Authorization Request'),'/auths');?></li>
	</ul>
</div>

<div class="actions">
	<ul>
	</br>
	</br>
	</br>
	<li><?php echo $this->Html->link(__('Sale Request'),'/sales');?></li>
	</ul>
</div>