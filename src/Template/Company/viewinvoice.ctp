<?php
$session = $this->request->session();
	$ThisInvoice = current($InvoiceQ);
	echo $this->Html->script("jquery/validate");
	$this->pageTitle= __('InvoiceRequestFrom', true).' '.__('InvoiceNumber', true) .' '.$ThisInvoice['Invoices']['InvoiceNumber'];
//localized validation code
	$TheJs = $session->read('LocaleCode').'/confirmsend';
	echo $this->Html->script($TheJs);
 ?>
 <div align="center">
 	<?php
		echo '<h3>',$this->pageTitle,'</h3>';
	 	include 'invoice.ctp';
		if($ThisInvoice['Invoices']['StatusID'] < 3){
	?>
	<form name="TheForm" id="TheForm" method="post" action="<?php echo $session->read('Company.CurrentURL'),'saveinvoice/'?>">
	<input type="hidden" value="<?php echo base64_encode($ThisInvoice['Invoices']['InvoiceID']) ?>" name="InvoiceID" id="InvoiceID">
		  		<table border="0" align="center" width="720" class="main">
				<td class="total"><label for="StatusID">*<?php echo __('Status') ?>:</label></td>
				<td nowrap="nowrap">
					<select name="StatusID" id="StatusID" tabindex="1">
			    	<?php foreach($StatusQ as $ThisStatus){
			   			if($ThisStatus['Status']['StatusID'] == $ThisInvoice['Invoices']['StatusID']){$Sel = " Selected ";}else{$Sel = "";}
						echo  '<option value="',$ThisStatus['Status']['StatusID'] ,'"',$Sel,'>',__($ThisStatus['Status']['Status']),'</option>',"\n";
						}
					?>
   	 				</select>
				</td>
				<td class="total"><label for="LocaleCode">*<?php echo __('Language') ?>:</label></td>
    			<td nowrap="nowrap">
    				<select name="LocaleCode" id="LocaleCode" tabindex="2">
				    	<?php foreach($LocalesQ as $ThisLocale){
				    		if($ThisLocale['Locales']['LocaleCode'] == Configure::read('Config.language')){$Sel = " Selected ";}else{$Sel = "";}
							echo  '<option value="',$ThisLocale['Locales']['LocaleCode'],'"',$Sel,'>',$ThisLocale['Locales']['Locale'],'</option>',"\n";
							}?>
				    </select>
				</td>
		</tr>
				<tr style="display:none;" id="RefNumber">
				    <td nowrap="nowrap" colspan="4" align="center"><label for="Reference">*<?php echo __('RefNumber') ?>:</label> <input tabindex="3" type="text" id="RefNumber" size="40" maxlength="100" name="RefNumber" value=""></td>
				 </tr>
				 <tr><td colspan="4">
				 	<table border="0" cellpadding="0" cellspacing="0" align="center">
				 	    <?php $ShowReq = "yes"; include 'notes.ctp'; ?>
						</table>
				 </td></tr>

		    <tr>
		    <th align="center" colspan="4">
		      <input tabindex="23" name="Continue" type="submit" id="Continue" value="<?php echo __('Continue') ?>">
			  <?php if($ThisInvoice['Invoices']['StatusID'] == 1){?>
			  	&nbsp;<input name="Edit" type="Button" id="SendMail" value="<?php echo __('EditInvoice') ?>" onclick="window.location.href='<?php echo $session->read('Company.CurrentURL'),'editinvoice/',base64_encode($ThisInvoice['Invoices']['InvoiceID'])?>/'">
				<?php } ?><br>&nbsp;
		   </th>
		  </tr>
			</table>
	 </form>
	 <?php }else{ ?><br>&nbsp;
	 	<table border="0" cellpadding="0" cellspacing="0" align="center">
			    <?php include 'notes.ctp'; ?>
		</table>
	<?php } ?>
	 <?php echo '<p align="center"><a href="',$session->read('Company.CurrentURL'),'">', __('BackToList'),'</a></p>';  ?>
</div>
