<div class="sales view">
<h2><?php  echo __('Sale');?></h2>
	<dl>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address1'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ExpDate'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['expDate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CardValidationNum'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['cardValidationNum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['response']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AuthMessage'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['authMessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LitleTxnId'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['litleTxnId']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreditAmount'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['creditAmount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreditLitleTxnId'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['creditLitleTxnId']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreditMessage'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['creditMessage']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sale'), array('action' => 'edit', $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sale'), array('action' => 'delete', $sale['Sale']['id']), null, __('Are you sure you want to delete # %s?', $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale'), array('action' => 'add')); ?> </li>
	</ul>
</div>
