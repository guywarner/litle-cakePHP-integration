<?php?>
<h1><a href="http://www.litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<fieldset>
		<h2 align="center";><b><?php echo __('Welcome to the Litle & Co. Cake PHP demo App'); ?></b></h2>
</fieldset>

<h2>About Litle</h2>

<p><a href="http://www.litle.com/developers">Litle &amp; Co.</a> powers the payment processing engines for leading companies that sell directly to consumers through  internet retail, direct response marketing (TV, radio and telephone), and online services. Litle &amp; Co. is the leading, independent authority in card-not-present (CNP) commerce, transaction processing and merchant services.</p>

<h2>About the CakePHP Demo</h2>

<p>The cakePHP demo application utilizes the Litle SDK for PHP in order to process various transactions. The cakePHP demo application is publically hosted but can also be setup to run locally. Upon opeing the application the demo app will guide you through the transaction process. This application supoorts authorization, capture, refund, credit, authorization reversal, tokenization and sale transactions.</p>

<h2>To Set Up Locally</h2>
<ol>
<li>Download repository from git</li>
<li>Create a symbolic link to the folder or drop it into the /var/www/html directory</li>
<li>Import the table into mysql by importing /app/config/Schema/litleDemoTable.sql, adjust the app/config/database file to match your db settings</li>
<li>navigate to litle-cakePHP-integration/index.php inside a browser to view demo webb application</li>
</ol><p><br><br><br>Please contact Lilte &amp; Co. with any questions; you can reach us at <a href="mailto:SDKSupport@litle.com">SDKSupport@litle.com</a></p>
</ol><p>You can download the repository at <a href="https://github.com/LitleCo/litle-cakePHP-integration">https://github.com/LitleCo/litle-cakePHP-integration</a></p>
	</br>
	</br>
	</br>
<div class = "litleEnter" align ="center">
	<?php echo $this->Html->link(__('Begin'),'/auths');?>
</div>


