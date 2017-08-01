<?php
$session = $this->request->session();
$ThisInvoice = current($InvoiceQ);
$this->pageTitle= __('Paying', true).' '.__('InvoiceNumber', true) .' '.$ThisInvoice['InvoiceNumber'];
?>
<div align="center">
 	<?php
		echo '<h3>',$this->pageTitle,'</h3>';
	 	include 'invoice.ctp';
		if($ThisInvoice['StatusID'] < 3){
	?>
	<form name="ThePayForm" id="ThePayForm" method="post">
	<input type="hidden" value="<?php echo base64_encode($ThisInvoice['InvoiceID']) ?>" name="InvoiceID" id="InvoiceID">
	<input type="hidden" name="StatusID" value="4">
	<input type="hidden" name="CurrentNote" value="<?php  echo base64_encode($ThisInvoice['Note']) ?>">
  		<table border="0" align="center" width="720" class="main">
  			<tr>
				<td>
					<label for="Reference">*<?php echo __('RefNumber') ?>:</label>
					<input tabindex="3" type="text" id="RefNumber" size="40" maxlength="100" name="RefNumber" value="" required="required">
				</td>
			</tr>
			  <tr>
			    <td>
			    	<label for="Note">*<?php echo __('Note') ?>:</label>

					<blockquote><em><?php echo html_entity_decode(str_replace("\\r\\n", "<br>", $ThisInvoice['Note'])) ?></em><br>
						<textarea tabindex="16" wrap="soft" cols="75" rows="3" id="Note" name="Note" required="required"></textarea></blockquote>
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
</div>
<script>
$(document).ready(function() {

  $("#ThePayForm").on("submit",function(){
    var cia_datos = $("#ThePayForm").serializeHash();
    $.ajax({
      url:"/acompany/saveinvoice",
      data:cia_datos,
      type:"post",
      dataType:"json",
      success:function(dat){
        var data = dat.__serialize;
        CRContactos_Manager.check_errors(data);
        if(data.is_success == 1){
          new Noty({
              text: data.flash,
              type:'alert',
              timeout:4000,
                layout:'top',
              animation: {
                  open: 'animated bounceInLeft', // Animate.css class names
                  close: 'animated bounceOutLeft', // Animate.css class names
              }
          }).show();
					$(".invoice-edit-form-spot").html(" ");
		      $("#invoiceEditModal").modal("hide");
					setTimeout(function(){ loadStage("/dashboard/company"); }, 3000);
          //window.location.href = "#/MyCompany/";
        }
      }
    });
    return false;
  });

});
</script>
