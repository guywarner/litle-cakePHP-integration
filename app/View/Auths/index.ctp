<div class="auths index">
	<h2><?php echo __('Authorization Transaction Cycle Homepage');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><div align="center"><?php echo ('123123');?></th></div>
	</tr>
	<?php
	foreach ($auths as $auth): ?>
	<tr>
	<td><?php echo h($auth['Auth']['id']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['litleTxnId']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['amount']); ?>&nbsp;</td>

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
	</br>
	<h3><?php echo __('About Authorization'); ?></h3>
	<?php echo "The Authorization transaction enables you to confirm that a customer has submitted a valid payment method with their order and has sufficient funds to purchase the goods or services they ordered."?>
	</br>
	</br>
	<?php echo "Please click the New Auth Link Above to begin"?>
	</div>

