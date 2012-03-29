<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<div class="auths index">
	<h2><?php echo __('Transaction Homepage');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><div align="center"><?php echo ('Id');?></th></div>
			<th><div align="center"><?php echo $this->Paginator->sort('litleTxnId');?></th></div>
			<th><div align="center"><?php echo $this->Paginator->sort('Txn State');?></th></div>
			<th><div align="center"><?php echo $this->Paginator->sort('amount');?></th></div>
			<th><div align="center"><?php echo $this->Paginator->sort('message');?></th></div>
			<th><div align="center"><?php echo $this->Paginator->sort('Transaction Status');?></th></div>
			<th class="actions"><div align="center"><?php echo __('Actions');?></th></div>
	</tr>
	<?php
	foreach ($auths as $auth): ?>
	<tr>
		<?php 
			  $state = "";
			  $displayValue = array('');
			  $actualValue = array('');
			  if(($auth['Auth']['authMessage'] == "Approved") && ($auth['Auth']['captureMessage'] != "Approved") && ($auth['Auth']['authRevMessage'] != "Approved"))
			  {
			  	$state = 'Authorized';
			  	$displayValue = array('Auth Rev.', 'Capture', 'View');
			  	$actualValue = array( array('action' => 'authReversal', $auth['Auth']['id']), array('action' => 'capture', $auth['Auth']['id']), array('action' => 'authView', $auth['Auth']['id']));
			  }
			  else if(($auth['Auth']['authRevMessage'] == "Approved"))
			  {
			  	$state = 'Auth Reversed';
			  	$displayValue = array('View');
			  	$actualValue = array(array('action' => 'reauthView', $auth['Auth']['id']));
			  }
			   else if(($auth['Auth']['voidMessage'] == "Approved"))
			  {
			  	$state = 'Voided';
			  	  $displayValue = array('View');
			  	   $actualValue = array(array('action' => 'voidView', $auth['Auth']['id']) );
			  }
			   else if(($auth['Auth']['tokenMessage'] == "Account number was successfully registered") || ($auth['Auth']['tokenMessage'] =="Account number was previously registered"))
			  {
			  	$state = 'Tokenized';
			  	$displayValue = array('Sale w/Token','View');
			  	$actualValue = array( array('action' => 'saleToken', $auth['Auth']['id']),array('action' => 'tokenView', $auth['Auth']['id']));
			  }
			  else if(($auth['Auth']['saleMessage'] == "Approved"))
			  {
			  	$state = 'Auth & Captured';
			  	$displayValue = array('Credit', 'Void','View');
			  	$actualValue = array( array('action' => 'credit', $auth['Auth']['id']), array('action' => 'void', $auth['Auth']['id']),array('action' => 'saleView', $auth['Auth']['id']));
			  }
			  else if ($auth['Auth']['captureMessage'] == "Approved" && $auth['Auth']['creditMessage'] != "Approved")
			  {
				  $state = 'Captured';
				  $displayValue = array('Credit', 'Void','View');
			  	  $actualValue = array( array('action' => 'credit', $auth['Auth']['id']), array('action' => 'void', $auth['Auth']['id']), array('action' => 'captureView', $auth['Auth']['id']) );
			  }
			   else if ($auth['Auth']['creditMessage'] == "Approved")
			  {
				  $state = 'Refunded';
				  $displayValue = array('Void','View');
			  	   $actualValue = array(array('action' => 'void', $auth['Auth']['id']), array('action' => 'creditView', $auth['Auth']['id']) );
			  }
			  else if($auth['Auth']['response'] != "000" && $auth['Auth']['response'] != "")
			  {
			    $state = 'Failed Auth';
			    $displayValue = array('ReAuth');
			  	$actualValue = array( array('action' => 'reAuth', $auth['Auth']['id']));
			  }
			  else
			  {
			  	$state = 'Error';
			  	$actualValue =NULL;
			  }
		?>
		<td><?php echo h($auth['Auth']['id']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['litleTxnId']); ?>&nbsp;</td>
		<td><?php echo h($state); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['amount']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['message']); ?>&nbsp;</td>
		<td><?php echo h($auth['Auth']['transactionStatus']); ?>&nbsp;</td>
		<td class="actions"><div align="left">
		<?php 
			  if (isset($actualValue)){
			  	for($i = 0; $i < count($displayValue); $i++)
			  	{
			  		echo $this->Html->link(__($displayValue[$i]), $actualValue[$i]);
			  	}
			  }
		?>
		</div></td>
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
	<h2><?php echo __('Actions'); ?></h2>
	</br>
	<h3><?php echo __('About Authorization'); ?></h3>
	<?php echo "The Authorization transaction enables you to confirm that a customer has submitted a valid payment method with their order and has sufficient funds to purchase the goods or services they ordered."?>
	</br>
	</br>
		<ul>
		<li><?php echo $this->Html->link(__('New Auth'), array('action' => 'add')); ?></li>
	</ul>
	</br>
	<?php echo "Please click the New Auth Link Above to begin"?>
	</br>
	</br>
	<h3><?php echo __('About Sale'); ?></h3>
	<?php echo "The Sale transaction enables you to both authorize fund availability and deposit those funds by means of a single transaction. The Sale transaction is also known as a conditional deposit, because the deposit takes place only if the authorization succeeds. If the authorization is declined, the deposit will not be processed."?>
	</br>
	</br>
	<ul>
		<li><?php echo $this->Html->link(__('New Sale'), array('action' => 'sale')); ?></li>
	</ul>
	</br>
	<?php echo "Please click the New Sale Link Above to begin"?>
	</br>
	</br>
	<h3><?php echo __('About Tokenization'); ?></h3>
	<?php echo "Description of Tokenization goes here space fillere space filler space filler space filler"?>
	</br>
	</br>
	<ul>
		<li><?php echo $this->Html->link(__('New Register Token Request'), array('action' => 'token')); ?></li>
	</ul>
	</br>
	<?php echo "Please click the New Token Link Above to begin"?>
</div>

