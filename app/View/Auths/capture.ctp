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
		<h3><?php echo __('CAPTURE'); ?></h3>
		<a id="button" style="cursor: pointer"><?php echo __('SDK Implementation'); ?></a>
		<div id="effect" class = "effect" title="SDK Implementation">
			<div class = "gist">
				Full Capture: <br><br>
			</div>
			<script src="https://gist.github.com/2007140.js"> </script>
			<div class = "gist">
				Partial Capture: <br><br>
			</div>
			<script src="https://gist.github.com/2007034.js"> </script>
			<br>
		</div>
		
	
	<h3><?php echo __('User Input:'); ?></h3>
	<table>
		<tr>
			<td style="text-align: left;">
				<div class="input text">
					<?php echo $this->Form->input('captureAmount',array('disabled'=>TRUE,'onClick'=>"toggle()"));?>
				</div>
			</td>
			<td>
				(if left blank, the entire authorized amount will be captured)
			</td>
		</tr>
		<tr>
		<td colspan = "2" style="text-align: left;"><input type="hidden" name="data[Auth][partial]" id="AuthPartial_" value="0"/><input type="checkbox" name="data[Auth][partial]"  value="1" id="AuthPartial" onClick="toggle()"/>Partial Capture?</td>
		</tr>
	</table>
	
	</fieldset>
	<h3><?php echo __('Additional Values Being Passed:'); ?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><div align="center"><?php echo "Authorized Amount";?></th>
		<th><div align="center"><?php echo "Id";?></th>
		<th><div align="center"><?php echo "litleTxnId";?></th>
	</tr>
	<tr><div align = "center">
		<td><div align = "center"><?php echo $this->data['Auth']['amount']; ?>&nbsp;</td></div>
		<td><div align = "center"><?php echo $this->data['Auth']['id']; ?>&nbsp;</td></div>
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
	<h3><?php echo __('About Capture'); ?></h3>
	<?php echo "You use a Capture transaction to transfer previously authorized funds from the customer to you after order fulfillment. You can submit a Capture transaction for the full amount of the Authorization, or for a lesser amount by setting the partial attribute to true. "?>
	</br>
	</br>
	<?php echo "Please fill out the amount to be captured and check the box for a partial capture."?>
	</br>
	</br>
	<?php echo "You may click on the SDK Implementation link to view capture implementation."?>
	</br>
	</br>
	</div>
</div>
