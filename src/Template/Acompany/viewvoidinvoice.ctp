<?php
$session = $this->request->session();
	$ThisInvoice = current($InvoiceQ);

	$this->pageTitle= __('Voiding', true).' '.__('InvoiceNumber', true) .' '.$ThisInvoice['InvoiceNumber'];
 ?>
 <div class="animated pulse" align="center">
 	<?php
		echo '<h3>',$this->pageTitle,'</h3>';
	 	require 'invoice.ctp';
		if($ThisInvoice['StatusID'] < 3){
	?>
	<form name="TheVoidForm" id="TheVoidForm" method="post">
	<input type="hidden" value="<?php echo base64_encode($ThisInvoice['InvoiceID']) ?>" name="InvoiceID" id="InvoiceID">
	<input type="hidden" name="StatusID" value="5">
	<input type="hidden" name="CurrentNote" value="<?php  echo base64_encode($ThisInvoice['Note']) ?>">
  		<table border="0" align="center" width="720" class="main">
			  <tr>
			    <td>
			    	<label for="Note">*<?php echo __('Note') ?>:</label>

					<blockquote><em><?php echo htmlspecialchars_decode($ThisInvoice['Note']) ?></em><br>
						<textarea tabindex="16" wrap="soft" cols="75" rows="3" id="Note" name="Note"></textarea></blockquote>
					</td>
			  </tr>
			<?php $ShowReq = "yes"; require 'notes.ctp'; ?>
		    <th align="center" colspan="2">
		      <input tabindex="23" name="Continue" type="submit" id="Continue" value="<?php echo __('VoidInvoice') ?>">&nbsp;
     			 <?php echo __('CopyClient') ?>:<input type="checkbox" name="CopyClient" id="CopyClient" checked="checked" value="1" onclick="if(this.checked==false){return confirm('<?php echo __('DoNotCopyClient')?>');}"><br>&nbsp;
		   </th>
		  </tr>
		</table>
	 </form>
	 <?php } ?>
</div>
<script>
$(document).ready(function() {

  $("#TheVoidForm").on("submit",function(){
    var cia_datos = $("#TheVoidForm").serializeHash();
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
