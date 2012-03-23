<?php?>
<head>
  <title>Demo</title>
  <header id="Litle-branding">
      <div class="wrapper">
        <hgroup>
          <h1> <?php echo $this->Html->image('Litle.jpg');?></h1>
        </hgroup>

</head>
	<fieldset>
		<legend align="center";><?php echo __('Welcome to the Litle & Co. Cake PHP demo App'); ?></legend>
	<?php echo "The following code is an example of using the Litle & Co. Cake php plugin";?>
	</fieldset>
<?php ?>
</div>
<div class="actions">
	<h3><?php echo __('Front End: Customer'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Sale Request'),'/sales');?></li>
	</ul>
</div>
<div class="actions">
	<h3><?php echo __('Back End: Admin'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Admin Setup'),'/tokens');?></li>
		<li><?php echo $this->Html->link(__('Admin View'),'/tokens');?></li>
	</ul>
</div>

<div class="actions">
	<h3><?php echo __('All Code'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Register Token Requests'),'/tokens');?></li>
		<li><?php echo $this->Html->link(__('Authorization Request'),'/auths');?></li>
		<li><?php echo $this->Html->link(__('Sale Request'),'/sales');?></li>
	</ul>
</div>
<div class="actions">
	<h3><?php echo __('Additional Resources'); ?></h3>
	<ul>
		<li><a class="active" href="http://www.litle.com/" id="litlecotip" title="Litle &amp; Co. - Home" alt="Litle &amp; Co. - Home">Litle &amp; Co. - Home</a><li>
		<li><a class="active" href="http://www.litle.com/dev" id="litlecotip" title="Litle &amp; Co. - Developer" alt="Litle &amp; Co. - Developer">Litle &amp; Co. - Developer</a><li>
		<li><a class="active" href="http://www.github.com/" id="litlecotip" title="Github: Litle  PHP SDK" alt="Github:Litle  PHP SDK">Github:Litle  PHP SDK</a><li>
		<li><a class="active" href="http://www.github.com/" id="litlecotip" title="Github: Litle Cake PHP source code" alt="Github:Litle Cake PHP source code">Github:Litle Cake PHP source code</a><li>
		<li><a class="active" href="http://www.cakephp.org/" id="litlecotip" title="Cake PHP website" alt="Cake PHP website">Cake PHP website</a><li>
	</ul>
</div>