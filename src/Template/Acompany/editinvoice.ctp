<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$session = $this->request->session();
$ThisInvoice = current($InvoiceQ);
$this -> pageTitle = __('Editing', true) . ' ' . __('InvoiceNumber', true) . ' ' . $ThisInvoice['InvoiceNumber'];
echo '<h3>', $this -> pageTitle, '</h3>';
?>
<form name="TheEditForm" id="TheEditForm" method="post">
<input type="hidden" value="<?php echo base64_encode($ThisInvoice['InvoiceID']) ?>" name="InvoiceID" id="InvoiceID">
<input type="hidden" value="1" name="StatusID">
<table align="center" class="main" border="0">
	<tr>
   		 <td>
			<table width="100%" border="0">
				<tr>
					<td>&nbsp;</td>
					<td style="text-align:center;"><h3 style="font-size:23pt"><?php echo __('InvoiceRequestFrom') ?></h3></td>
				</tr>
				<tr>
					<td>
				<br>
					  	<div style="display:none;" id="RefNumber">
<label for="Reference">*<?php echo __('RefNumber') ?>:</label><br>
&nbsp;&nbsp;&nbsp;<!-- <input tabindex="3" type="text" id="RefNumber" size="50" maxlength="100" name="RefNumber" value="" required="required"/> -->
  </div>

					<label for="LocaleCode">*<?php echo __('Language') ?>:</label>&nbsp;&nbsp;&nbsp;
					<select name="LocaleCode" id="LocaleCode" tabindex="2">
				    	<?php
						foreach ($LocalesQ as $ThisLocale) {
							if ($ThisLocale['LocaleCode'] == Configure::read('Config.language')) {$Sel = " Selected ";
							} else {$Sel = "";
							}
							echo '<option value="', $ThisLocale['LocaleCode'], '"', $Sel, '>', $ThisLocale['Locale'], '</option>', "\n";
						}
					?>
				    </select><br>
					<label for="CurrencyID">*<?php echo __('Currency') ?>:</label>&nbsp;&nbsp;
					 <?php
					 	if(count($CurrencyQ) > 1){
					 		echo '<select id="CurrencyID" name="CurrencyID" tabindex="3">';
						 	foreach($CurrencyQ as $ThisCurrency){
								echo '<option value="',$ThisCurrency['CurrencyID'],'" symbol="',$ThisCurrency['CurrencySymbol'],'">',$ThisCurrency['CurrencyName'];
								echo ' ( ',$ThisCurrency['CurrencySymbol'],' )','</option>',"\n";
						 	}
							echo '</select>';
					 	}else{
								echo '<input id="CurrencyID"  name="CurrencyID" type="hidden" value="',$CurrencyQ[0]['CurrencyID'],'" >';
								echo $CurrencyQ[0]['CurrencyName'],' ( ',$CurrencyQ[0]['CurrencySymbol'],' )';
						}
					?>
					</td>
					<td nowrap  style="text-align:left;border: 1px none #999999; border-top-style:solid; border-left-style:solid;">

<label for="InvoiceNumber">*<?php echo __('InvoiceNumber') ?>:</label><input type="text" name="InvoiceNumber" id="InvoiceNumber" value="<?php echo $ThisInvoice['InvoiceNumber'] ?>" size="15" maxlength="25" required="required"></td>
					</td>
					</tr>
      		</table>
	  </td>
  </tr>
  <tr>
  	<td align="left">
			<label for="ClientID">*<?php echo __('Client') ?>:</label>
				<select name="ClientID" id="ClientID" tabindex="5">
					<option value=""><?php echo __('PleaseSelect') ?></option>
			    	<?php
						foreach ($ClientsQ as $ThisClient) {
							if ($ThisClient['ClientID'] == $ThisInvoice['ClientID']) {$Sel = " Selected ";
							} else {$Sel = "";
							}
							echo '<option value="', $ThisClient['ClientID'], '"', $Sel, '>', $ThisClient['ClientName'], ' ', $ThisClient['ClientLastName'], ' (', $ThisClient['Email'], ')</option>', "\n";
						}
					?>
    			</select>
	</td>
  </tr>
    <tr>
    <td nowrap="nowrap"><label for="EmailSubject">*<?php echo __('EmailSubject') ?>:</label> <input tabindex="15" type="text" id="EmailSubject" size="79" maxlength="255" name="EmailSubject" value="<?php echo $ThisInvoice['EmailSubject'] ?>" required="required"></td>
  </tr>
  <tr>
    <td><label for="Note"><?php echo __('Note') ?>:</label><blockquote><textarea tabindex="16" wrap="soft" cols="75" rows="3" id="Note" name="Note"><?php echo $ThisInvoice['Note'] ?></textarea></blockquote></td>
  </tr>

  <tr>
    <td>
			<table width="95%" class="detail" id="FormDetailB" align="center">
        <tr class="detail">
          <td class="title"><?php echo __('Qty') ?></td>
          <td class="title"><?php echo __('Description') ?></td>
		<td class="title"><?php echo __('UnitPrice') ?></td>
          <td class="title"><?php echo __('Amount') ?></td>
          <td class="title">&nbsp;</td>
        </tr>
		<?php
		$Total = 0;
		$LineNum = 0;
		foreach ($InvoiceDetailQ as $ThisDetail) {

			echo '<tr id="Lineb', $LineNum, '" class="line lines linebb'.$LineNum.'">';
			echo '<td align="center" nowrap="nowrap">';

			echo ' <input name="Qty[]" type="number"  size="2" maxlength="2" value="', $ThisDetail['Qty'], '" class="qty"/></td>';
			echo '<td><input name="Desc[]" type="text" size="50" maxlength="255" value="', $ThisDetail['Description'], '" class="form-control" /></td>';
			echo '<td align="center" nowrap="nowrap"><label><span class="currency">', $ThisInvoice['CurrencySymbol'], '</span></label><input name="UnitPrice[]"  type="number" id="UnitPrice'.$LineNum.'" size="9" maxlength="9" class="unitprice" value="', number_format($ThisDetail['UnitPrice'], 2), '"/></td>';
			echo '<td align="center" nowrap="nowrap"><label><span class="currency">', $ThisInvoice['CurrencySymbol'], '</span></label><input name="Amount[]" type="number" id="Amount'.$LineNum.'" tabindex="-1" value="', number_format($ThisDetail['Amount'], 2), '" size="9" maxlength="9" readonly="readonly" class="amount"/></td>';
			echo '<td align="center" nowrap="nowrap" style="text-align:center;width:30px;"> ';
	      	if($LineNum < 1){
	  			$TheStyle = 'display:none';
	      	}else{
	     		$TheStyle = null;
				}
?>
<button type="button" trid="Lineb<?php echo $LineNum;?>" invoice_detail_id="<?php echo $ThisDetail['InvoiceDetailID'];?>" class="btn btn-danger btn-xs remove-lineb" style="<?php echo $TheStyle;?>"><i class="fa fa-times"></i></button>
<input type="hidden" name="InvoiceDetailID[]" value="<?php echo $ThisDetail['InvoiceDetailID'];?>"/>
<?php
					echo '</td>';
			echo '</tr>';
			$LineNum++;

			$Total = $Total + $ThisDetail['Amount'];
		}
	?>
      <tr id="LastLineb">
        <td colspan="4">&nbsp;</td>
       </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="center"><button type="button" class="btn btn-default" name="AddRowb" id="AddRowb" > <?php echo __('AddRow') ?></button></td>
        <td align="right"><label><b><?php echo __('Total') ?>:</b></label></td>
        <td align="center" nowrap="nowrap"><label><span class="currency"><?php echo $ThisInvoice['CurrencySymbol'] ?></span></label><input name="InvoiceTotal" type="text" id="InvoiceTotalb" tabindex="-1" size="9" maxlength="12" readonly="readonly" class="total" value="<?php echo number_format($Total, 2) ?>"></td>
        </tr>
			</table>
			</td>
  </tr>
  <?php
	$ShowReq = "yes";
 ?>
 <?php echo $this->element('Admin/notes'); ?>
    <tr>
    <th>
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo __('Edit') ?></button>&nbsp;
     <button invoice_id="<?php echo $ThisInvoice['InvoiceID']; ?>" type="button" class="btn btn-info btn-sendmail"><i class="fa fa-envelope"></i> <?php echo __('SendInvoice') ?></button>
   </th>
  </tr>
</table>
</form>
<table style="display:none;">
	<tr id="Line0" class="lines">
		<td align="center" nowrap="nowrap"><input name="Qty[]" min="0" tabindex="17" type="number" id="Qty0" size="2" maxlength="2" value="1" class="qty" required="required"></td>
		<td nowrap="nowrap"><input name="Desc[]" tabindex="18"  type="text" id="Desc[]" size="30" maxlength="255" value="" required="required" class="form-control" ></td>
		<td align="center" nowrap="nowrap"><label><span class="currency">$</span></label><input name="UnitPrice[]"  min="0" tabindex="19"  type="number" id="UnitPrice0" size="4" maxlength="9" class="unitprice" value="0"></td>
		<td align="center" nowrap="nowrap">
			<label><span class="currency">$</span></label>
			<input name="Amount[]" type="number" id="Amount0" tabindex="-1" value="0" size="6" maxlength="9" readonly="readonly" class="amount">
		</td>
		<td><button type="button" trid="Line0" class="btn btn-danger btn-xs remove-lines hide"><i class="fa fa-times"></i></button></td></tr>
</table>
<script>
$(document).ready(function() {

var lineTpl = '<tr id="Line0" class="lines">\
	<td align="center" nowrap="nowrap"><input name="Qty[]" min="0" tabindex="17" type="number" id="Qty0" size="2" maxlength="2" value="1" class="qty" required="required"></td>\
	<td nowrap="nowrap"><input name="Desc[]" tabindex="18"  type="text" id="Desc[]" size="30" maxlength="255" value="" required="required" class="form-control" ></td>\
	<td align="center" nowrap="nowrap"><label><span class="currency">$</span></label><input name="UnitPrice[]"  min="0" tabindex="19"  type="number" id="UnitPrice0" size="4" maxlength="9" class="unitprice" value=""></td>\
	<td align="center" nowrap="nowrap">\
		<label><span class="currency">$</span></label>\
		<input name="Amount[]" type="number" id="Amount0" tabindex="-1" value="" size="6" maxlength="9" readonly="readonly" class="amount">\
	</td>\
	<td><button type="button" trid="Line0" class="btn btn-danger btn-xs remove-lines hide"><i class="fa fa-times"></i></button></td></tr>';

	$(".btn-sendmail").on("click",function(){
		if(window.confirm("<?php echo __('SendInvoice') ?>?")){
			var invoice_id = $(this).attr("invoice_id");
			$.ajax({
	      url:"/acompany/sendemail",
	      data:{invoice_id:invoice_id},
	      type:"get",
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
	                  open: 'animated bounceInLeft',
	                  close: 'animated bounceOutLeft',
	              }
	          }).show();
						$(".invoice-edit-form-spot").html(" ");
			      $("#invoiceEditModal").modal("hide");
						setTimeout(function(){ loadStage("/dashboard/company"); }, 3000);
	        }
	      }
	    });
		}
	});

  $("#TheEditForm").on("submit",function(){
    //var cia_datos = $("#TheEditForm").serializeHash();
		var cia_datos = $("#TheEditForm").serialize();
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
        }
      }
    });
    return false;
  });

	var count = $(".lines").length;// + 1;
	$("#AddRowb").on("click",function() {
		NewLine = $("#Line0").clone(true);
//NewLine = lineTpl;
		TheNewID = "Lineb" + count;
		NewLine.attr("id", TheNewID);
		NewLine.insertBefore("#LastLineb");
		//$("#" + TheNewID + " :text").attr("value", " ");
		$(NewLine).find("a").show();
		$("#" + TheNewID + " #Qty0").focus();
		$("#" + TheNewID + " #Qty0").attr("id","Qty"+count);
		$("#" + TheNewID + " #Amount0").attr("id","Amount"+count);
		$("#Desc" + count ).css("width","100%");
		$("#" + TheNewID + " #Desc0").attr("id","Desc"+count);
		$("#" + TheNewID + " #UnitPrice0").attr("id","UnitPrice"+count);
		$("#" + TheNewID + " #Qty"+count).focus();
		$("#" + TheNewID + " .remove-lines").attr("trid",TheNewID);
		$("#" + TheNewID + " .remove-lines").addClass("show");
		$("#" + TheNewID + " .remove-lines").addClass("remove-lines");
		count++;
		return false;
	});

$(document).on("click",".remove-lineb",function(){
//console.log($(this).attr("trid")+" ==== "+ $(this).attr("invoice_detail_id"));
var trid  = $(this).attr("trid");
$("#"+trid).remove();

updateLines();
});

	$(".remove-lines").on("click",function(){
		var trid  = $(this).attr("trid");
		$("#"+trid).remove();

		updateLines();

	});

setInterval(function(){
	//console.log("intervel..");
	updateLines();
}, 1000);

	/*$("#InvoiceDate").datepicker({
		showOn : "both",
		defaultDate : +1,
		buttonImage : '/img/calendar.gif',
		buttonImageOnly : true,
		dateFormat : "mm/dd/yy"
	});*/

	$("#StatusID").change(function() {
		if ($("#StatusID").attr("value") == 4) {
			$("#RefNumber").show();
		} else {
			$("#RefNumber").hide();
		}
	});

	$("#FormDetailB :input").blur(function(evt) {
		updateLines();
	});

function updateLines(){
	var n = 0;
	$("tr .lines").each(function(i) {
		if ($(this).attr("id") != '') {

		TheVar = "#" + this.id + " input:eq(0)";
		Qty = $(TheVar).val();
		if ((isNaN(Qty) || Qty.length == 0) || Qty < 1) {
			$(TheVar).val(0);
			Qty = 0;
		}
		TheVar = "#" + this.id + " input:eq(2)";

		UnitPrice = $(TheVar).val();

		if (isNaN(UnitPrice) || UnitPrice.length == 0 || UnitPrice < 0) {
			$(TheVar).val(0);
			UnitPrice = 0;
		}
		TheUP = parseFloat(UnitPrice).toFixed(2);
		TheUP = UnitPrice;
		$(TheVar).val(TheUP);
		Amount = parseInt(Qty) * parseFloat(UnitPrice);
		Amount = Qty * UnitPrice;
		if (isNaN(Amount)) {
			Amount = 0;
		}

		Amount = Amount.toFixed(2)
		TheVar = "#" + this.id + " input:eq(3)";
		//$("#Amount"+n).val(Amount);
		$(TheVar).val(Amount);
	}
	n++;
});
var Total = 0;
$(".amount").each(function(i) {
	Total = (parseFloat(Total) + parseFloat($(this).val()));
})
//Total = Total.toFixed(2);
$("#InvoiceTotalb").attr("value", Total);
}

	$("#ClientID").addToList({
		form : '#ClientForm',
		insertPosition : 'first',
		dataHandler : function(data) {
			return {
				value : data.ClientID,
				label : data.ClientName
			}
		}
	});

	$('#ClientID').bind('form-open', function() {
		$('#TheClientForm').clearForm();
		$('#TheBusForm').clearForm();
		$('#TheClientForm label.error').remove();
		$('#TheBusForm label.error').remove();
		$('#TheClientForm *').removeClass("error");
		$('#TheBusForm *').removeClass("error");
		$('#TheClientForm *').removeClass("checked");
		$('#TheBusForm *').removeClass("checked	");
		$('#QuickSubmitP').attr("value", $('#ButOrValP').attr("value"));
		$('#QuickSubmitP').attr("disabled", false);
		$('#CloseP').attr("disabled", false);
		$('#QuickSubmitB').attr("value", $('#ButOrValB').attr("value"));
		$('#QuickSubmitB').attr("disabled", false);
		$('#CloseB').attr("disabled", false);

	});

	$('#CloseB, #CloseP').click(function() {
		$('#ClientID').trigger('form-cancel');
	});

	$('#New').click(function() {
		$('#ClientID').trigger('form-open');
	});

	$("#CurrencyID").change(function() {
		$("#CurrencyID option:selected").each(function() {
			$(".currency").html(($(this).attr("symbol")));
		})
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

	$(".hidecomments").fadeOut("slow");
	$(".comments").slideUp("slow", function() {
		$(".showcomments").fadeIn("slow");
	});

	$(".DelLine").click(function(){
		if(confirm($(this).attr('msg'))){
			$(this).parent().parent().fadeOut('slow').remove();
			$("#Qty").focus();
			var Total = 0
			$(".amount").each(function(i) {
				Total = (parseFloat(Total) + parseFloat(this.value));
			})
			Total = Total.toFixed(2);
			$("#InvoiceTotalb").attr("value", Total);
		};
		return false;
	});
});
</script>
