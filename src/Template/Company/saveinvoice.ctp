<?php 
	$this->pageTitle= __('InvoiceRequestFrom', true).' '.$session->read('Company.CurrentName');
	$javascript->link('showhide', false);
	$ThisInvoice = current($InvoiceQ);
	echo '<p align="center">',__('SendInstructions'),'</a></p>'; 
?>

<form name="TheForm" id="TheForm" method="post" action="<?php echo $session->read('Company.CurrentURL'),'sendmail/'?>">
<input type="hidden" value="<?php echo  base64_encode($ThisInvoice['Invoices']['InvoiceID']) ?>" name="InvoiceID[]" id="InvoiceID">
<table border="0" align="center"width="750">
  <tr>
    <td colspan="4" align="center">
		<?php  include 'invoice.ctp' ?>
	</td>
  </tr>
  <?php if($ThisInvoice['Invoices']['StatusID'] < 3){ ?>
   <?php  include  'notes.ctp';  }?>
     <tr>
    <th colspan="4" align="center">
      <input name="SendMail" type="submit" id="SendMail" value="<?php echo __('SendEmailTo'),' ',$ThisInvoice['Clients']['Email'];  ?>" onclick="return confirm('<?php echo __('SendMailConfirm'),' ',$ThisInvoice['Clients']['Email']  ?>?')">
	&nbsp;<input name="Edit" type="Button" id="SendMail" value="<?php echo __('EditInvoice') ?>" onclick="window.location.href='<?php echo $session->read('Company.CurrentURL'),'editinvoice/',base64_encode($ThisInvoice['Invoices']['InvoiceID'])?>/'">
   </th>
  </tr>
</table>
<?php echo '<p align="center"><a href="',$session->read('Company.CurrentURL'),'">', __('BackToList'),'</a></p>'; ?>