<?php
$session = $this->request->session();

	if(!isset($Protocol)){
		if(isset($_SERVER['HTTPS'])){
			$Protocol = "https://";
		}else{
			$Protocol = "http://";
		}
	}
if(isset($ThisInvoice['StatusID'])){
	if($ThisInvoice['StatusID'] == 3){
		echo '<h3><b>***',__('InvoicePaid'),'***</b></h3>';
	}
	if($ThisInvoice['StatusID'] == 4){
		echo '<h2><b>***',__('InvoicePaidManually'),'***</b></h2>';
	}
}
?>
<style>
.button {
  font: bold 14px Arial;
  text-decoration: none;
  background-color: #EEEEEE;
  color: #333333;
  padding: 4px 8px 4px 4px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
}
</style>
<table align="center" class="main" style="background-color:<?php echo $session->read('Company.CurrentBgColor') ?>">
	<tr>
    <td>
			<table width="100%" border="0">
				<tr>
					<td>&nbsp;
			<!-- <img src="<?php //echo $Protocol,$_SERVER['SERVER_NAME'],'/img',$session->read('Company.CurrentURL'),$session->read('Company.CurrentLogo') ?>" alt="<?php //echo $session->read('Company.CurrentName') ?>" align="left">--></td>
					<td style="text-align:center;"><h3 style="font-size:23pt"><b><?php echo __('InvoiceRequestFrom') ?></b></h3></td>
				</tr>
				<tr>
					<td align="left" nowrap="nowrap">
  <img src="http://nicapagos.com<?= $_SESSION['Company']['CurrentLogo']?>" height="50"/>
						<?php
					echo '<b>',$session->read('Company.CurrentName'),'</b>';
					if($session->check('Company.CurrentInfo')){
						echo '<br>',$session->read('Company.CurrentInfo');
					}
					 ?></td>
					<td nowrap style="text-align:left;border: 1px none #999999; border-top-style:solid; border-left-style:solid;padding-left:40px">
						<span class="black">
						<?php
						echo '<b>', __('InvoiceDate'), ':</b> ';
						if($session->read('LocaleCode') == 'spa_cr'){
							//echo strtotime($ThisInvoice['InvoiceDate']);
							echo date('l, F j Y', strtotime($ThisInvoice['InvoiceDate']));
						}else{
							echo date('l, F j Y', strtotime($ThisInvoice['InvoiceDate']));
						}
						echo '<br><b>',__('InvoiceNumber'), '</b>: ', $ThisInvoice['InvoiceNumber'];
						if($session->check('TransactionID')){
							echo '<br><b>',__('TransactionID'),':</b> ', $session->read('TransactionID');
						}
						if($ThisInvoice['StatusID'] == 3){
							echo '<br><b>', __('PaidDate'), ':</b> ';
							if($session->read('LocaleCode') == 'spa_cr'){
								//echo strtotime($ThisInvoice['PaidDate']);
								echo date('l, F j Y', strtotime($ThisInvoice['PaidDate']));
							}else{
								echo date('l, F j Y', strtotime($ThisInvoice['PaidDate']));
							}
							echo '<br><b>',__('AuthNumber'), ':</b> ', $ThisInvoice['AuthNumber'];
							echo '<br><b>',__('TransactionID'),':</b> ', $ThisInvoice['TransactionID'];
							}
							if($ThisInvoice['StatusID'] == 4){
							echo '<br><b>', __('ManualPaidDate'), ':</b> ';
							if($session->read('LocaleCode') == 'spa_cr'){
								//echo strtotime($ThisInvoice['PaidDate']);
								echo date('l, F j Y', strtotime($ThisInvoice['PaidDate']));
							}else{
								echo date('l, F j Y', strtotime($ThisInvoice['PaidDate']));
							}
							echo '<br><b>',__('RefNumber'), ':</b> ', $ThisInvoice['AuthNumber'];
							}
							if($ThisInvoice['StatusID'] == 5){
							echo '<br><b>', __('VoidDate'), ':</b> ';
							if($session->read('LocaleCode') == 'spa_cr'){
								//echo strtotime($ThisInvoice['VoidDate']);
								echo date('l, F j Y', strtotime($ThisInvoice['VoidDate']));
							}else{
								echo date('l, F j Y', strtotime($ThisInvoice['VoidDate']));
							}
							echo '<br><b>',__('VoidBy'), ':</b> ', $ThisInvoice['AuthNumber'];
							}
						?>
						</span>
						</td>
				</tr>
      </table>		</td>
  </tr>
  <tr>
		<td align="left">
			<span class="black"><?php
			echo '<b>',__('Client'),':</b> ',$ThisInvoice['ClientName'],' ',$ThisInvoice['ClientLastName'];
			echo '<br><b>',__('Email'),':</b> ',$ThisInvoice['Email'];
			?>
		</span>
	</td>
  </tr>
	<?php
			if(isset($ShowCedJur)){
				echo '<tr><td align="center"><table width="90%" class="detail" align="center"><tr><td class="detailc">';
				echo '<p><b>***',__('ValidationInfo1'),'***<br>***',__('ValidationInfo2'),'***</b></p>';
				if(strlen(trim($ThisInvoice['RazonSocial']) > 0)){
					$Raz = str_replace('<br>&nbsp;&nbsp;', ' ', __('RazonSocial', true));
					echo '<b>',$Raz,':</b> <span class="black">',$ThisInvoice['RazonSocial'],'</span> ';
				}
				if(strlen(trim($ThisInvoice['CedulaJuridica']) > 0)){
					$Ced = str_replace('<br>&nbsp;&nbsp;', ' ', __('CedulaJuridica', true));
					echo '  <b>',$Ced,':</b> <span class="black">',$ThisInvoice['CedulaJuridica'],'</span>';
				}
				echo '<br>&nbsp;</td></tr></table></td></tr>';
			}
	?>
  <tr>
    <td width="100%">
			<table  width="100%" class="detail">
        <tr class="detail">
          <td class="title" width="20%"><?php echo __('Qty') ?></td>
          <td class="title" width="40%"><?php echo __('Description') ?></td>
		<td class="title" width="20%"><?php echo __('UnitPrice') ?></td>
          <td class="title" width="20%"><?php echo __('Amount') ?></td>
        </tr>
		<?php
		$Total = 0;
		foreach($InvoiceDetailQ as $ThisDetail){

			echo '<tr>';
			echo '<td class="detailc">',$ThisDetail['Qty'],'</td>';
			echo '<td class="detailc">',$ThisDetail['Description'],'</td>';
			echo '<td class="detail">',$ThisInvoice['CurrencySymbol'],number_format($ThisDetail['UnitPrice'], 2),'&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			echo '<td class="detail">',$ThisInvoice['CurrencySymbol'],number_format($ThisDetail['Amount'],2),'</td>';
        echo '</tr>';

		$Total = $Total + $ThisDetail['Amount'];
		}?>
			</table>
			</td>
  </tr>
	<tr>
    <td>
			<table class="detail" align="right">
        <tr>
					<td class="total" width="150px" align="right"><b><?php echo __('Total') ?>:</b></td>
					<td class="detail" width="150px" align="right"><?php echo $ThisInvoice['CurrencySymbol']; ?>&nbsp;<?=$Total;?></td>
			  </tr>
			</table>		</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?php if(strlen(trim($ThisInvoice['Note'])) > 0){ ?>
	<tr>
    <td><?php echo '<b>',__('Note'),':</b><br><div class="commenttext"><em>',html_entity_decode(str_replace("\\r\\n", "<br>", $ThisInvoice['Note'])),'</em></div>'  ?></td>
  </tr>
	<?php }?>
	<tr>
    <td><hr><blockquote><?php echo __('Thanks')?></blockquote></td>
  </tr>
</table>
