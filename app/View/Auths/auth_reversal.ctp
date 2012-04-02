<h1><a href="http://www.Litle.com/developers"><?php echo $this->Html->image('Litle.jpg');?></a></h1>
<script>
function toggle() {
  var checkbox = document.getElementById("AuthPartial");
  var toggle = document.getElementById("AuthCaptureAmount");
  if(!checkbox.checked){
  	toggle.value="";
  }
  updateToggle = checkbox.checked ? toggle.disabled=false : toggle.disabled=true;
}
</script>
<div class="auths form">
<?php echo $this->Form->create('Auth');?>
	<fieldset>
		<h3><?php echo __('Authorization Reversal'); ?></h3>
		<a id="button" style="cursor: pointer"><?php echo __('SDK Implementation'); ?></a>
		<div id="effect" class = "effect" title="SDK Implementation">
			<div class = "gist">
				Full Authorization Reversal: <br><br>
			</div>
			<script src="https://gist.github.com/2230606.js"> </script>
			<div class = "gist">
				Partial Authorization Reversal: <br><br>
			</div>
			<script src="https://gist.github.com/2283749.js"> </script>
			<br>
		</div>
	
	</fieldset>
	<h3><?php echo __('Additional Values Being Passed:'); ?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><div align="center"><?php echo "litleTxnId";?></th>
	</tr>
	<tr><div align = "center">
		<td><div align = "center"><?php echo $this->data['Auth']['litleTxnId']; ?>&nbsp;</td></div>
	</tr>
	</table>
<?php echo $this->Form->end(__('Submit'));?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back to Homepage'), array('action' => 'index'));?></li>
	</ul>
	</br>
	<h3><?php echo __('About Auth Reversal'); ?></h3>
	<?php echo "The primary use of Authorization Reversal transactions is to eliminate any unused amount on an unexpired Authorization. Issuing an Authorization Reversal has the benefit of freeing any remaining held amount that reduces the buying power of your customer. Potentially, this both increases customer satisfaction and can allow them to proceed with additional purchases that may otherwise be blocked by credit limits. It also helps you avoid any misuse of Auth fees imposed by the card associations."?>
	</br>
	</br>
	<?php echo "No user fields are needed for an auth reversal transaction."?>
	</br>
	</br>
	<?php echo "You may click on the SDK Implementation link to view authorization transaction implementation."?>
	</br>
	</br>
	</div>
</div>
	
