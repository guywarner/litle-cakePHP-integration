<div class="auths index">
	<h2><?php echo __('Auths');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
	
	<th><?php echo 'index2';?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('address1');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('country');?></th>
			<th><?php echo $this->Paginator->sort('zip');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('number');?></th>
			<th><?php echo $this->Paginator->sort('expDate');?></th>
			<th><?php echo $this->Paginator->sort('cardValidationNum');?></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('message');?></th>
			<th><?php echo $this->Paginator->sort('response');?></th>
			<th><?php echo $this->Paginator->sort('authMessage');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($auths as $auth): ?>
	<tr>
		<td><?php echo h($auth['Auth']['amount']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['name']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['address1']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['city']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['state']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['country']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['zip']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['email']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['type']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['number']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['expDate']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['cardValidationNum']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['id']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['message']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['response']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['authMessage']); ?>&nbsp;</td>
		<td class="actions">
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
