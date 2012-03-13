<div class="tokens view">
<h2><?php  echo __('Register Token Request View');?></h2>
	<dl>
		<dt><?php echo __('id'); ?></dt>
		<dd>
			<?php echo h($token['Token']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registered card number'); ?></dt>
		<dd>
			<?php echo h($token['Token']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('response'); ?></dt>
		<dd>
			<?php echo h($token['Token']['tokenMessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('litleToken'); ?></dt>
		<dd>
			<?php echo h($token['Token']['litleToken']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('saleAmount'); ?></dt>
		<dd>
			<?php echo h($token['Token']['saleAmount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($token['Token']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AddressLine1'); ?></dt>
		<dd>
			<?php echo h($token['Token']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($token['Token']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($token['Token']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($token['Token']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($token['Token']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($token['Token']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($token['Token']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CardValidationNum'); ?></dt>
		<dd>
			<?php echo h($token['Token']['cardValidationNum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ExpDate'); ?></dt>
		<dd>
			<?php echo h($token['Token']['expDate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('saleLitleTxnId'); ?></dt>
		<dd>
			<?php echo h($token['Token']['saleLitleTxnId']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('saleMessage'); ?></dt>
		<dd>
			<?php echo h($token['Token']['saleMessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('creditAmount'); ?></dt>
		<dd>
			<?php echo h($token['Token']['creditAmount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('creditLitleTxnId'); ?></dt>
		<dd>
			<?php echo h($token['Token']['creditLitleTxnId']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('creditMessage'); ?></dt>
		<dd>
			<?php echo h($token['Token']['creditMessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('voidMessage'); ?></dt>
		<dd>
			<?php echo h($token['Token']['voidMessage']); ?>
			&nbsp;
		</dd>
	
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete Transaction'), array('action' => 'delete', $token['Token']['id']), null, __('Are you sure you want to delete # %s?', $token['Token']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tokenized Transaction'), array('action' => 'add')); ?> </li>
	</ul>
</div>
