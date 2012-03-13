<div class="auths index">
	<h2><?php echo __('Auths');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('message');?></th>
			<th><?php echo $this->Paginator->sort('response');?></th>
			<th><?php echo $this->Paginator->sort('authMessage');?></th>
			<th><?php echo $this->Paginator->sort('litleTxnId');?></th>
			<th><?php echo $this->Paginator->sort('captureAmount');?></th>
			<th><?php echo $this->Paginator->sort('captureLitleTxnId');?></th>
			<th><?php echo $this->Paginator->sort('captureMessage');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($auths as $auth): ?>
	<tr>
		<td><?php echo h($auth['Auth']['amount']); ?>&nbsp;</td>

		<td><?php echo h($auth['Auth']['id']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['message']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['response']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['authMessage']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['litleTxnId']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['captureAmount']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['captureLitleTxnId']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['captureMessage']); ?>&nbsp;</td>
		<td class="actions">
		
			<?php echo $this->Html->link(__('Capture'), array('action' => 'capture', $auth['Auth']['id'])); ?>
			<?php echo $this->Html->link(__('Credit'), array('action' => 'credit', $auth['Auth']['id'])); ?>
			<?php echo $this->Html->link(__('Void'), array('action' => 'void', $auth['Auth']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $auth['Auth']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $auth['Auth']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $auth['Auth']['id']), null, __('Are you sure you want to delete # %s?', $auth['Auth']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Auth'), array('action' => 'add')); ?></li>
	</ul>
</div>
