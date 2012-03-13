<div class="sales index">
	<h2><?php echo __('Sales');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('message');?></th>
			<th><?php echo $this->Paginator->sort('response');?></th>
			<th><?php echo $this->Paginator->sort('authMessage');?></th>
			<th><?php echo $this->Paginator->sort('litleTxnId');?></th>
			<th><?php echo $this->Paginator->sort('creditAmount');?></th>
			<th><?php echo $this->Paginator->sort('creditLitleTxnId');?></th>
			<th><?php echo $this->Paginator->sort('creditMessage');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($sales as $sale): ?>
	<tr>
		<td><?php echo h($sale['Sale']['amount']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['id']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['message']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['response']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['authMessage']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['litleTxnId']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['creditAmount']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['creditLitleTxnId']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['creditMessage']); ?>&nbsp;</td>
		<td class="actions">
		
			<?php echo $this->Html->link(__('Credit'), array('action' => 'credit', $sale['Sale']['id'])); ?>
			<?php echo $this->Html->link(__('Void'), array('action' => 'void', $sale['Sale']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sale['Sale']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sale['Sale']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sale['Sale']['id']), null, __('Are you sure you want to delete # %s?', $sale['Sale']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sale'), array('action' => 'add')); ?></li>
	</ul>
</div>
