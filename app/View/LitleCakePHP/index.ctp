<head>
  <header id="Litle-branding">
      <div class="wrapper">
        <hgroup>
          <h1> <?php echo $this->Html->image('Litle.jpg');?></h1>
        </hgroup>
</head>
	<fieldset>
		<legend align="center";><?php echo __('Welcome to the Litle & Co. Cake PHP demo App'); ?></legend>
	</fieldset>

	<h3><?php echo __('About Litle & Co.'); ?></h3>
	<ul>
		<?php echo "Litle & Co. powers the payment processing engines for leading companies that sell directly to consumers through internet retail, direct response marketing (TV, radio and telephone), and online services. Litle & Co. is the leading, independent authority in card-not-present (CNP) commerce, transaction processing and merchant services. Follow the link located below to redirect to the Litle Developers Portal or to our page on Github";?>

	</ul>
	</br>
	<h3><?php echo __('About This Demo'); ?></h3>
	<ul>
		<?php echo "Litle & Co. powers the payment processing engines for leading companies that sell directly to consumers through internet retail, direct response marketing (TV, radio and telephone), and online services. Litle & Co. is the leading, independent authority in card-not-present (CNP) commerce, transaction processing and merchant services.";?>
	</ul>

	<h3><?php echo __('Transactions'); ?></h3>
<div class="actions">
	<ul>
	</br>
		<li><?php echo $this->Html->link(__('Register Token Requests'),'/tokens');?></li>
	</ul>
</div>

<div class="actions">
	<ul>
	</br>
	</br>
	</br>
	<li><?php echo $this->Html->link(__('Authorization Request'),'/auths');?></li>
	</ul>
</div>

<div class="actions">
	<ul>
	</br>
	</br>
	</br>
	<li><?php echo $this->Html->link(__('Sale Request'),'/sales');?></li>
	</ul>
</div>