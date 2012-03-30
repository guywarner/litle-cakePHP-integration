<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths view">
<h2><?php  echo __('Sale View');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ExpDate'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['expDate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CVV'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['cardValidationNum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['saleResponse']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sale Message'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['saleMessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LitleTxnId'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['saleLitleTxnId']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transaction'), array('action' => 'edit', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Transaction'), array('action' => 'delete', $auth['Auth']['id']), null, __('Are you sure you want to delete # %s?', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Back to  Homepage'), array('action' => 'index')); ?> </li>
	</ul>
	<br>
<br>
<br>
</div>
<div class="actions">
	<h3><?php echo __('Related Transactions'); ?></h3>
	<ul>		
		<li><?php echo $this->Html->link(__('Credit View'), array('action' => 'creditView', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Void View'), array('action' => 'voidView', $auth['Auth']['id'])); ?> </li>
	</ul>
</div>
