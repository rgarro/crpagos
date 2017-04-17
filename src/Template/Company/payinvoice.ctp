<?php
$session = $this->request->session();
	$ThisInvoice = current($InvoiceQ);
	echo $this->Html-> css("nyroModal");
	$this->pageTitle= __('Paying', true).' '.__('InvoiceNumber', true) .' '.$ThisInvoice['InvoiceNumber'];
	echo $this->Html->script("jquery/validate");
//localized validation code
	$TheJs = $session->read('LocaleCode').'/payinvoice';
	echo $this->Html->script($TheJs);
 ?>
 <div align="center">
 	<?php
		echo '<h3>',$this->pageTitle,'</h3>';
	 	include 'invoice.ctp';
		if($ThisInvoice['Invoices']['StatusID'] < 3){
	?>
	<form name="TheForm" id="TheForm" method="post" action="<?php echo '/company/','saveinvoice/'?>">
	<input type="hidden" value="<?php echo base64_encode($ThisInvoice['InvoiceID']) ?>" name="InvoiceID" id="InvoiceID">
	<input type="hidden" name="StatusID" value="4">
	<input type="hidden" name="CurrentNote" value="<?php  echo base64_encode($ThisInvoice['Note']) ?>">
  		<table border="0" align="center" width="720" class="main">
  			<tr>
				<td>
					<label for="Reference">*<?php echo __('RefNumber') ?>:</label>
					<input tabindex="3" type="text" id="RefNumber" size="40" maxlength="100" name="RefNumber" value="">
				</td>
			</tr>
			  <tr>
			    <td>
			    	<label for="Note">*<?php echo __('Note') ?>:</label>

					<blockquote><em><?php echo html_entity_decode(str_replace("\\r\\n", "<br>", $ThisInvoice['Note'])) ?></em><br>
						<textarea tabindex="16" wrap="soft" cols="75" rows="3" id="Note" name="Note"></textarea></blockquote>
					</td>
			  </tr>
			<?php $ShowReq = "yes"; include 'notes.ctp'; ?>
		    <th align="center" colspan="2">
		      <input tabindex="23" name="Continue" type="submit" id="Continue" value="<?php echo __('PayThisInvoice') ?>">
		     <?php echo __('CopyClient') ?>:<input type="checkbox" name="CopyClient" id="CopyClient" checked="checked" value="1" onclick="if(this.checked==false){return confirm('<?php echo __('DoNotCopyClient')?>');}"><br>&nbsp;
		   </th>
		  </tr>
		</table>
	 </form>
	 <?php } ?>
	 <?php echo '<p align="center"><a href="',$session->read('Company.CurrentURL'),'">', __('BackToList'),'</a></p>';  ?>
</div>
