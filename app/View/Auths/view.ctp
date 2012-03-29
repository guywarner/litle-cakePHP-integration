<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths view">
<h2><?php  echo __('Auth');?></h2>
	<dl>
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
		<dt><?php echo __('Address1'); ?></dt>
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
		<dt><?php echo __('CardValidationNum'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['cardValidationNum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['response']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AuthMessage'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['authMessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LitleTxnId'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['litleTxnId']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CaptureAmount'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['captureAmount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CaptureLitleTxnId'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['captureLitleTxnId']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CaptureMessage'); ?></dt>
		<dd>
			<?php echo h($auth['Auth']['captureMessage']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Auth'), array('action' => 'edit', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Auth'), array('action' => 'delete', $auth['Auth']['id']), null, __('Are you sure you want to delete # %s?', $auth['Auth']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Auths'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Auth'), array('action' => 'add')); ?> </li>
	</ul>
</div>
