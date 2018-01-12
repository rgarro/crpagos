<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$session = $this->request->session();
$ThisInvoice = current($InvoiceQ);
$this -> pageTitle = __('Editing', true) . ' ' . __('InvoiceNumber', true) . ' ' . $ThisInvoice['InvoiceNumber'];
//echo $this->Html-> css("default/ui.datepicker","stylesheet", array(), false);
echo $this->Html-> css("ui");
//$html -> css("tabs", "stylesheet", array(), false);
echo $this->Html->script("jquery/jquery.form");
echo $this->Html->script("jquery/jquery.addtolist");
echo $this->Html->script("jquery/jquery.ui");
echo $this->Html->script("jquery/validate");
echo $this->Html->script("jquery/jquery.cookie");
echo $this->Html->script("invoice");
//localized validation code
$TheJs = $session -> read('LocaleCode') . '/validateinvoice';
echo $this->Html->script($TheJs);
$TheJs1 = $session -> read('LocaleCode') . '/checkclient';
echo $this->Html->script($TheJs1);
//localized datepiecker
$TheUiJs = 'jquery/ui/i18n/ui.datepicker-' . $session -> read('LocaleCode');
echo $this->Html->script($TheUiJs);
echo '<h3>', $this -> pageTitle, '</h3>';
?>
<form name="TheForm" id="TheForm" method="post" action="/company/saveinvoice/">
<input type="hidden" value="<?php echo base64_encode($ThisInvoice['InvoiceID']) ?>" name="InvoiceID" id="InvoiceID">
<table align="center" class="main" border="0">
	<tr>
   		 <td>
			<table width="100%" border="0">
				<tr>
					<td><img hspace="10" src="<?php echo '/img',$session->read('Company.CurrentURL'),$session->read('Company.CurrentLogo') ?>" alt=""></td>
					<td style="text-align:center;"><h3 style="font-size:23pt"><?php echo __('InvoiceRequestFrom') ?></h3></td>
				</tr>
				<tr>
					<td>
				<label for="StatusID">*<?php echo __('Status') ?>:</label>&nbsp;&nbsp;
				<select name="StatusID" id="StatusID" tabindex="1">
			    	<?php
					foreach ($StatusQ as $ThisStatus) {
						if ($ThisStatus['StatusID'] == $ThisInvoice['StatusID']) {$Sel = " Selected ";
						} else {$Sel = "";
						}
						echo '<option value="', $ThisStatus['StatusID'], '"', $Sel, '>', __($ThisStatus['Status']), '</option>', "\n";
					}
					?>
   	 				</select><br>
					  	<div style="display:none;" id="RefNumber">
<label for="Reference">*<?php echo __('RefNumber') ?>:</label><br>
&nbsp;&nbsp;&nbsp;<input tabindex="3" type="text" id="RefNumber" size="50" maxlength="100" name="RefNumber" value="">
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
					<label for="InvoiceDate">*<?php echo __('InvoiceDate') ?>:</label>
	<?php
						if ($session -> read('LocaleCode') == 'spa_cr') {$DateMask = "Y-m-d H:i:s";
						} else {$DateMask = "Y-m-d H:i:s";
						}
 ?> <input type="text" name="InvoiceDate" id="InvoiceDate" value="<?php echo date($DateMask, strtotime($ThisInvoice['InvoiceDate'])); ?>" size="10" maxlength="10" tabindex="4"><br>
<label for="InvoiceNumber">*<?php echo __('InvoiceNumber') ?>:</label><input type="text" name="InvoiceNumber" id="InvoiceNumber" value="<?php echo $ThisInvoice['InvoiceNumber'] ?>" size="15" maxlength="25"></td>
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
				 <optgroup label="-------------------------------------">
				<option value="-1"><?php echo __('AddNewClient') ?></option>
				</optgroup>
    			</select>&nbsp;<input type="button" name="New" id="New" value="<?php echo __('AddNewClient')?>">
	</td>
  </tr>
    <tr>
    <td nowrap="nowrap"><label for="EmailSubject">*<?php echo __('EmailSubject') ?>:</label> <input tabindex="15" type="text" id="EmailSubject" size="79" maxlength="255" name="EmailSubject" value="<?php echo $ThisInvoice['EmailSubject'] ?>"></td>
  </tr>
  <tr>
    <td><label for="Note"><?php echo __('Note') ?>:</label><blockquote><textarea tabindex="16" wrap="soft" cols="75" rows="3" id="Note" name="Note"><?php echo $ThisInvoice['Note'] ?></textarea></blockquote></td>
  </tr>

  <tr>
    <td>
			<table width="95%" class="detail" id="FormDetail" align="center">
        <tr class="detail">
          <td class="title"><?php echo __('Qty') ?></td>
          <td class="title"><?php echo __('Description') ?></td>
		<td class="title"><?php echo __('UnitPrice') ?></td>
          <td class="title"><?php echo __('Amount') ?></td>
          <td class="title">&nbsp;</td>
        </tr>
		<?php
		$Total = 0;
		$LineNum = 1;
		foreach ($InvoiceDetailQ as $ThisDetail) {
			echo '<tr id="Line', $LineNum, '" class="line">';
			echo '<td align="center" nowrap="nowrap"> <input name="Qty[]" type="text" id="Qty" size="2" maxlength="2" value="', $ThisDetail['Qty'], '" class="qty"></td>';
			echo '<td nowrap="nowrap"><input name="Desc[]" type="text" id="Desc" size="50" maxlength="255" value="', $ThisDetail['Description'], '"></td>';
			echo '<td align="center" nowrap="nowrap"><label><span class="currency">', $ThisInvoice['CurrencySymbol'], '</span></label><input name="UnitPrice[]"  type="text" id="UnitPrice" size="9" maxlength="9" class="unitprice" value="', number_format($ThisDetail['UnitPrice'], 2), '"></td>';
			echo '<td align="center" nowrap="nowrap"><label><span class="currency">', $ThisInvoice['CurrencySymbol'], '</span></label><input name="Amount[]" type="text" id="Amount" tabindex="-1" value="', number_format($ThisDetail['Amount'], 2), '" size="9" maxlength="9" readonly="readonly" class="amount"></td>';
			echo '<td align="center" nowrap="nowrap" style="text-align:center;width:30px;">';
	      	if($LineNum == 1){
	  			$TheStyle = 'display:none';
	      	}else{
	     		$TheStyle = null;
	      	}
			echo '<a style="font-size:0.8em;',$TheStyle,'" href="#" class="DelLine" msg="',__('DeleteLineConfirm'),'">', __('DeleteLine'), '</a>';
      		echo '</td>';
			echo '</tr>';
			$LineNum++;

			$Total = $Total + $ThisDetail['Amount'];
		}
	?>
      <tr id="LastLine">
        <td colspan="4">&nbsp;</td>
       </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="center"><a href="#" name="AddRow" id="AddRow" tabindex="20"><b>&raquo;<?php echo __('AddRow') ?></b></a></td>
        <td align="right"><label><b><?php echo __('Total') ?>:</b></label></td>
        <td align="center" nowrap="nowrap"><label><span class="currency"><?php echo $ThisInvoice['CurrencySymbol'] ?></span></label><input name="InvoiceTotal" type="text" id="InvoiceTotal" tabindex="-1" size="9" maxlength="12" readonly="readonly" class="total" value="<?php echo number_format($Total, 2) ?>"></td>
        </tr>
			</table>
			</td>
  </tr>
  <?php $ShowReq = "yes";
	include 'notes.ctp';
 ?>
    <tr>
    <th>
      <input tabindex="23" name="Continue" type="submit" id="Continue" value="<?php echo __('Continue') ?>">&nbsp;
     <?php echo __('CopyClient') ?>:<input type="checkbox" name="CopyClient" id="CopyClient" checked="checked" value="1" onclick="if(this.checked==false){return confirm('<?php echo __('DoNotCopyClient')?>');}"><br>&nbsp;
   </th>
  </tr>
</table>
</form>
<?php
	include 'quickadd.ctp';
	?>
<p align="center"><a href='/company' onclick="return confirm('<?php echo  __('BackConfirm')?>')"><?php echo  __('BackToList')?></a></p>
