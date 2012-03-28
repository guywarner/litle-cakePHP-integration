<div class="Tokens form">
<?php echo $this->Form->create('Token');?>
	<fieldset>
		<legend><?php echo __('CAPTURE'); ?></legend>
	<?php
		echo $this->Form->input('voidType');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Auths'), array('action' => 'index'));?></li>
	</ul>
</div>
