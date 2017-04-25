<?php
$session = $this->request->session();
	$CurrentRow = 0;
	$RecordCount = count($InvoicesQ);

	$CurrentStatus = "0";
	foreach($InvoicesQ as $ThisInvoice){
		if($CurrentStatus != $ThisInvoice['StatusID']){
			if(($CurrentRow != 0) && ($CurrentRow != $RecordCount)){
//make sure it won't do it on first or last rows
//Button Row
				echo '<tr><th colspan="7" style="text-align:left">';
				if(isset($ResendOK)){
					echo '<input type="Submit" name="Resend" value="',($ThisInvoice['StatusID']==2)?  __('SendMail'): __('ResendMail'),'">';
					unset($ResendOK);
				}else{
					echo '&nbsp;';
				}
				echo '</th></tr>';
//close previous div and tables
				echo '</table>';
				echo '</form>';
				echo '</div>';
				echo "\n";
			}
			echo "\n";
			echo '<div id="tabs-',$ThisInvoice['StatusID'] ,'">';
			if($ThisInvoice['StatusID'] < 3){
				echo '<form method="post" action="/company/sendmail/" name="Resend" id="Resend">';
				$ResendOK = "Ok";
			}elseif($ThisInvoice['StatusID'] == 5){
				echo '<form method="post" action="/company/delete/" name="Delete" id="Delete">';
				$DeleteOK = "Ok";
			}

			echo '<table class="zebra" style="width:98%">';
			echo '<tr>';
			echo '<th style="width:30px">&nbsp;</th>';
			echo '<th style="width:127px">',  __('InvoiceDate') ,'&nbsp;<a href="?Sort=',$OtherSort,'" title=',__('Sort'),'><img src="/img/',$SortImage,'" width="12" height="12"></a></th>';
			echo '<th style="width:129px">',  __('InvoiceNumber'),'</th>';
			echo '<th style="width:265px">', __('Client'),'</th>';
			echo '<th style="width:59px">',__('Amount'),'</th>';
			echo '<th style="width:265px">',__('Description'),'</th>';
			echo '<th style="width:30px">&nbsp</th>';
			echo '</tr>';
			$CurrentStatus = $ThisInvoice['StatusID'];;
		}

		echo '<tr>';
		echo '<td align="center" class="left">';
		if($ThisInvoice['StatusID'] < 3){
			echo '<input type="checkbox" name="InvoiceID[]" class="radios" value="',base64_encode($ThisInvoice['InvoiceID']),'">';
		}elseif($ThisInvoice['StatusID'] == 5){
			echo '<input type="checkbox" name="InvoiceID[]" class="radios" value="',base64_encode($ThisInvoice['InvoiceID']),'">';
		}else{
			echo '&nbsp;';
		}
		echo '</td>';
		echo '<td align="center" style="font-size:0.8em">';
		if($session->read('LocaleCode') == 'spa_cr'){
			echo ucwords(strftime('%A %d de %B del %Y',strtotime($ThisInvoice['InvoiceDate'])));
		}else{
			echo ucwords(strftime('%A, %B %d %Y',strtotime($ThisInvoice['InvoiceDate'])));
		}
		echo '</td>';
		echo '<td align="center">',$ThisInvoice['InvoiceNumber'],'</td>';
		echo '<td style="font-size:0.8em">',$ThisInvoice['ClientName'],' ',$ThisInvoice['ClientLastName'],' (',$ThisInvoice['Email'],')</td>';
		echo '<td align="right" nowrap="nowrap">',$ThisInvoice['Currencies']['CurrencySymbol'],' ', number_format($ThisInvoice['TheTotal'], "2"),'</td>';
		echo '<td style="font-size:0.8em">',$ThisInvoice['ShortDesc'],'</td>';
		echo '<td align="center" class="right" >';
		if($ThisInvoice['StatusID'] == 1){
//Pending: Edit all
			echo '&bull;<a href="/company/editinvoice/',base64_encode($ThisInvoice['InvoiceID']),'/">',__('EditInvoice'),'</a>';
		}elseif($ThisInvoice['StatusID'] == 2){
//Sent: PayManually / Void
			echo '&bull;<a href="/company/payinvoice/',base64_encode($ThisInvoice['InvoiceID']),'/">',__('PayLink'),'</a>';
			echo '<br>';
			echo '&bull;<a href="/company/voidinvoice/',base64_encode($ThisInvoice['InvoiceID']),'/">',__('VoidLink'),'</a>';
		}else{
//Paid: Read Only
			echo '&bull;<a href="/company/viewinvoice/',base64_encode($ThisInvoice['InvoiceID']),'/">',__('ViewLink'),'</a>';
		}
		echo '</td>';
		echo '</tr>';
		$CurrentRow++;
		if($CurrentRow == $RecordCount){
//Close Last Div nad Table
				echo '<tr><th colspan="7" style="text-align:left">';
				if(isset($ResendOK)){
					echo '<input type="Submit" name="Resend" value="',($ThisInvoice['StatusID']==2)?  __('SendMail'): __('ResendMail'),'">';
					unset($ResendOK);
				}elseif(isset($DeleteOK)){
					echo '<input type="Submit" name="Delete" value="', __('DeleteSelected'),'" onclick="return confirm(\'',__('DeleteInvoiceConfirm'),'\'))">';
					unset($DeleteOK);
				}else{
					echo '&nbsp;';
				}
				echo '</th></tr>';
			echo '</table>';
			echo '</form>';
			echo '</div>';
		}
	}

	echo '<div id="tabs-search">';
	require 'search.ctp';
	echo '</div>';
?>
