<?php
$session = $this->request->session();
$ThisInvoice = current($InvoiceQ);

$this->pageTitle= __('InvoiceRequestFrom', true).' '.__('InvoiceNumber', true) .' '.$ThisInvoice['InvoiceNumber'];
?>
 <div class="animated pulse" align="center">
 	<?php
		echo '<h3>',$this->pageTitle,'</h3>';
    //echo $this->element('Admin/invoice',["ThisInvoice"=>$ThisInvoice]);
    include 'invoice.ctp';
		if($ThisInvoice['StatusID'] < 3){
	?>
	<form name="TheForm" id="TheForm" method="post" action="'/company/saveinvoice/">
	<input type="hidden" value="<?php echo base64_encode($ThisInvoice['InvoiceID']) ?>" name="InvoiceID" id="InvoiceID">
		  		<table border="0" align="center" width="720" class="main">
				<td class="total"><label for="StatusID">*<?php echo __('Status') ?>:</label></td>
				<td nowrap="nowrap">
					<select name="StatusID" id="StatusID" tabindex="1">
			    	<?php foreach($StatusQ as $ThisStatus){
			   			if($ThisStatus['StatusID'] == $ThisInvoice['StatusID']){$Sel = " Selected ";}else{$Sel = "";}
						echo  '<option value="',$ThisStatus['StatusID'] ,'"',$Sel,'>',__($ThisStatus['Status']),'</option>',"\n";
						}
					?>
   	 				</select>
				</td>
				<td class="total"><label for="LocaleCode">*<?php echo __('Language') ?>:</label></td>
    			<td nowrap="nowrap">
    				<select name="LocaleCode" id="LocaleCode" tabindex="2">
				    	<?php foreach($LocalesQ as $ThisLocale){
				    		if($ThisLocale['LocaleCode'] == Configure::read('Config.language')){$Sel = " Selected ";}else{$Sel = "";}
							echo  '<option value="',$ThisLocale['LocaleCode'],'"',$Sel,'>',$ThisLocale['Locale'],'</option>',"\n";
							}?>
				    </select>
				</td>
		</tr>
				<tr style="display:none;" id="RefNumber">
				    <td nowrap="nowrap" colspan="4" align="center"><label for="Reference">*<?php echo __('RefNumber') ?>:</label> <input tabindex="3" type="text" id="RefNumber" size="40" maxlength="100" name="RefNumber" value=""></td>
				 </tr>
				 <tr><td colspan="4">
				 	<table border="0" cellpadding="0" cellspacing="0" align="center">
				 	    <?php $ShowReq = "yes"; require 'notes.ctp'; ?>
						</table>
				 </td></tr>

		    <tr>
		    <th align="center" colspan="4">
		      <input tabindex="23" name="Continue" type="submit" id="Continue" value="<?php echo __('Continue') ?>">
			  <?php if($ThisInvoice['StatusID'] == 1){?>
			  	&nbsp;<input name="Edit" type="Button" id="SendMail" value="<?php echo __('EditInvoice') ?>" onclick="window.location.href='/company/editinvoice/<?php echo base64_encode($ThisInvoice['InvoiceID'])?>">
				<?php } ?><br>&nbsp;
		   </th>
		  </tr>
			</table>
	 </form>
	 <?php }else{ ?><br>&nbsp;
	 	<table border="0" cellpadding="0" cellspacing="0" align="center">
			    <?php require 'notes.ctp'; ?>
          <?php //echo $this->element('Admin/notes'); ?>
		</table>
	<?php } ?>
</div>
<script>
$(document).ready(function(){


	$(".hidecomments").fadeOut("slow");
	$(".comments").slideUp("slow", function() {
		$(".showcomments").fadeIn("slow");
	});

	$(".commentslink").click(function() {
		if ($(".comments").is(":hidden")) {
			$(".showcomments").fadeOut("slow");
			$(".comments").slideDown("slow", function() {
				$(".hidecomments").fadeIn("slow");
			});

		} else {
			$(".hidecomments").fadeOut("slow");
			$(".comments").slideUp("slow", function() {
				$(".showcomments").fadeIn("slow");
			});

		}
		return false;
	});

});
</script>
