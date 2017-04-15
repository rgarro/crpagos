<?php
	$this->pageTitle= __('AddNewInvoiceFor', true).' '.$session->read('Company.CurrentName');
	$html->css("ui","stylesheet", array(), false);
//	$html->css("tabs","stylesheet", array(), false);
	$javascript->link("jquery/jquery.ui", false);
	$javascript->link("jquery/jquery.form", false);
	$javascript->link("jquery/jquery.addtolist", false);
	$javascript->link("jquery/jquery.cookie", false);
	$javascript->link("jquery/validate", false);
	$javascript->link("invoice", false);
//localized validation code
	$TheJs = $session->read('LocaleCode').'/validateinvoice';
	$javascript->link($TheJs, false);
	$TheJs1 = $session->read('LocaleCode').'/checkclient';
	$javascript->link($TheJs1, false);
//localized datepiecker
	$TheUiJs = 'jquery/ui/i18n/ui.datepicker-'.$session->read('LocaleCode');
	$javascript->link("$TheUiJs", false);
	echo '<h3>',$this->pageTitle,'</h3>';
?>
<form name="TheForm" id="TheForm" method="post" action="<?php echo $session->read('Company.CurrentURL'),'saveinvoice/'?>">
<table align="center" class="main" border="0">
	<tr>
			<td>
			<table width="100%" border="0">
				<tr>
					<td><img hspace="10" src="<?php echo '/img',$session->read('Company.CurrentURL'),$session->read('Company.CurrentLogo') ?>" alt=""></td>
					<td style="text-align:center;"><h3 style="font-size:23pt"><b><?php echo __('InvoiceRequestFrom') ?></b></h3></td>
				</tr>
				<tr>
					<td align="left">
					<label for="LocaleCode">*<?php echo __('Language') ?>:</label>&nbsp;&nbsp;&nbsp;
					<select name="LocaleCode" id="LocaleCode" tabindex="2">
						<?php foreach($LocalesQ as $ThisLocale){
							if($ThisLocale['Locales']['LocaleCode'] == Configure::read('Config.language')){$Sel = " Selected ";}else{$Sel = "";}
							echo  '<option value="',$ThisLocale['Locales']['LocaleCode'],'"',$Sel,'>',$ThisLocale['Locales']['Locale'],'</option>',"\n";
							}?>
					</select><br>
					<label for="CurrencyID">*<?php echo __('Currency') ?>:</label>&nbsp;&nbsp;
					<?php
						if(count($CurrencyQ) > 1){
							echo '<select id="CurrencyID" name="CurrencyID" tabindex="3">';
							foreach($CurrencyQ as $ThisCurrency){
								echo '<option value="',$ThisCurrency['Currencies']['CurrencyID'],'" symbol="',$ThisCurrency['Currencies']['CurrencySymbol'],'">',$ThisCurrency['Currencies']['CurrencyName'];
								echo ' ( ',$ThisCurrency['Currencies']['CurrencySymbol'],' )','</option>',"\n";
							}
							echo '</select>';
						}else{
								echo '<input id="CurrencyID"  name="CurrencyID" type="hidden" value="',$CurrencyQ[0]['Currencies']['CurrencyID'],'" >';
								echo $CurrencyQ[0]['Currencies']['CurrencyName'],' ( ',$CurrencyQ[0]['Currencies']['CurrencySymbol'],' )';
						}
					?>
					</td>
					<td nowrap style="text-align:left;border: 1px none #999999; border-top-style:solid; border-left-style:solid;padding-left:40px">
					<label for="InvoiceDate">*<?php echo __('InvoiceDate') ?>:</label>
	<?php if($session->read('LocaleCode') == 'spa_cr'){$DateMask="m/d/Y";}else{$DateMask="m/d/Y";} ?> <input type="text" name="InvoiceDate" id="InvoiceDate" value="<?php echo date($DateMask); ?>" size="10" maxlength="10" tabindex="4"><br>
<label for="InvoiceNumber">*<?php echo __('InvoiceNumber') ?>:</label><input type="text" name="InvoiceNumber" id="InvoiceNumber" value="" size="15" maxlength="25"></td>
					</td>
					</tr>
			</table>
	</td>
</tr>
<tr>
	<td align="left" >
			<label for="ClientID">*<?php echo __('Client') ?>:</label>
				<select name="ClientID" id="ClientID" tabindex="6" style="width:316px;">
					<option value=""><?php echo __('PleaseSelect') ?></option>
					<?php foreach($ClientsQ as $ThisClient){
							echo  '<option value="',$ThisClient['Clients']['ClientID'],'">',$ThisClient['Clients']['ClientName'],' ',$ThisClient['Clients']['ClientLastName'],' (',$ThisClient['Clients']['Email'],')</option>',"\n";
					}?>
				<optgroup label="-------------------------------------">
				<option value="-1"><?php echo __('AddNewClient') ?></option>
				</optgroup>
				</select>&nbsp;<input tabindex="7" type="button" name="New" id="New" value="<?php echo __('AddNewClient')?>">
	</td>
</tr>
	<tr>
	<td nowrap="nowrap"><label for="EmailSubject">*<?php echo __('EmailSubject') ?>:</label> <input tabindex="15" type="text" id="EmailSubject" size="79" maxlength="255" name="EmailSubject" value=""></td>
</tr>
<tr>
	<td><label for="Note"><?php echo __('Note') ?>:</label><blockquote><textarea tabindex="16" wrap="soft" cols="75" rows="3" id="Note" name="Note"><?php echo $session -> read('Company.CurrentDefaultNote') ?></textarea></blockquote></td>
</tr>

<tr>
	<td>
			<table width="95%" class="detail" id="FormDetail" align="center">
		<tr class="detail">
		<td class="title"><?php echo __('Qty') ?></td>
		<td class="title"><?php echo __('Description') ?></td>
		<td class="title"><?php echo __('UnitPrice') ?></td>
		<td class="title"><?php echo __('Amount') ?></td>
		</tr>
		<tr id="Line1" class="line">
			<td align="center" nowrap="nowrap"><input name="Qty[]" tabindex="17" type="text" id="Qty[]" size="2" maxlength="2" value="1" class="qty"></td>
			<td nowrap="nowrap"><input name="Desc[]" tabindex="18"  type="text" id="Desc[]" size="50" maxlength="255" value=""></td>
			<td align="center" nowrap="nowrap"><label><span class="currency">$</span></label><input name="UnitPrice[]" tabindex="19"  type="text" id="UnitPrice[]" size="9" maxlength="9" class="unitprice" value=""></td>
			<td align="center" nowrap="nowrap"><label><span class="currency">$</span></label><input name="Amount[]" type="text" id="Amount[]" tabindex="-1" value="" size="9" maxlength="9" readonly="readonly" class="amount"></td>
			</tr>
	<tr id="LastLine">
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td align="right">&nbsp;</td>
		<td align="center"><a href="#" name="AddRow" id="AddRow" tabindex="20"><b>&raquo;<?php echo __('AddRow') ?></b></a></td>
		<td align="right"><label><b><?php echo __('Total') ?>:</b></label></td>
		<td align="center" nowrap="nowrap"><label><span class="currency">$</span></label><input name="InvoiceTotal" type="text" id="InvoiceTotal" tabindex="-1" size="9" maxlength="9" readonly="readonly" class="total" value=""></td>
		</tr>
			</table>
			</td>
</tr>
<?php include 'notes.ctp'; ?>
	<tr>
	<th>
	<input tabindex="21" name="Continue" type="submit" id="Continue" value="<?php echo __('Continue') ?>"><br>&nbsp;
</th>
</tr>
</table>
</form>
<?php
	include 'quickadd.ctp';
	echo '<p align="center"><a href="',$session->read('Company.CurrentURL'),'" onclick="return confirm(\'', __('BackConfirm'),'\');">', __('BackToList'),'</a></p>';
?>
<script language="JavaScript">
	$(document).ready(function(){
		$("#ClientID").attr("selectedIndex", "0");
	});
</script>
