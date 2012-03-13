<?php?>
	<fieldset>
		<legend><?php echo __('Welcome to Litle & Co Cake PHP demo App'); ?></legend>
	<?php
	?>
	</fieldset>
<?php ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Register Token Requests'),'/tokens');?></li>
		<li><?php echo $this->Html->link(__('Authorization Request'),'/auths');?></li>
		<li><?php echo $this->Html->link(__('Sale Request'),'/sales');?></li>
	</ul>
</div>