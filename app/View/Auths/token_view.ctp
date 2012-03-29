<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths view">
<h2><?php  echo __('Token View');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CC Number'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Litle Token'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['litleToken']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['response']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['tokenMessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LitleTxnId'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['tokenLitleTxnId']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Auth'), array('action' => 'edit', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Auth'), array('action' => 'delete', $auth['Auth']['id']), null, __('Are you sure you want to delete # %s?', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Back to  Homepage'), array('action' => 'index')); ?> </li>
	</ul>
	<br>
<br>
<br>
<h3><?php echo __('Related Transactions'); ?></h3>
	<ul>	
		<li><?php echo $this->Html->link(__('Token Sale View'), array('action' => 'tokenSaleView', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Credit View'), array('action' => 'creditView', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Void View'), array('action' => 'voidView', $auth['Auth']['id'])); ?> </li>
	</ul>
</div>
