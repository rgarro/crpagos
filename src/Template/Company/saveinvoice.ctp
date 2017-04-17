<?php
$session = $this->request->session();
	$this->pageTitle= __('InvoiceRequestFrom', true).' '.$session->read('Company.CurrentName');
	echo $this->Html->script('showhide');
	$ThisInvoice = current($InvoiceQ);
	echo '<p align="center">',__('SendInstructions'),'</a></p>';
?>

<form name="TheForm" id="TheForm" method="post" action="<?php echo '/company/sendmail/'?>">
<input type="hidden" value="<?php echo  base64_encode($ThisInvoice['InvoiceID']) ?>" name="InvoiceID[]" id="InvoiceID">
<table border="0" align="center"width="750">
  <tr>
    <td colspan="4" align="center">
		<?php  include 'invoice.ctp' ?>
	</td>
  </tr>
  <?php if($ThisInvoice['StatusID'] < 3){ ?>
   <?php  include  'notes.ctp';  }?>
     <tr>
    <th colspan="4" align="center">
      <input name="SendMail" type="submit" id="SendMail" value="<?php echo __('SendEmailTo'),' ',$ThisInvoice['Email'];  ?>" onclick="return confirm('<?php echo __('SendMailConfirm'),' ',$ThisInvoice['Email']  ?>?')">
	&nbsp;<input name="Edit" type="Button" id="SendMail" value="<?php echo __('EditInvoice') ?>" onclick="window.location.href='<?php echo '/company/editinvoice/',base64_encode($ThisInvoice['InvoiceID'])?>/'">
   </th>
  </tr>
</table>
<p align="center"><a href="/company/"><?php echo  __('BackToList') ?></a></p>
