<?php
$session = $this->request->session();
?>
<INPUT TYPE="hidden" NAME="IDACQUIRER" value="<?php echo $session -> read('Company.AcquirerID');?>">
<INPUT TYPE="hidden" NAME="IDCOMMERCE" value="<?php echo $session -> read('Company.CommerceID');?>">
<INPUT TYPE="hidden" NAME="XMLREQ" value="<?php echo $VPosData['XMLREQ'];?>">
<INPUT TYPE="hidden" NAME="DIGITALSIGN" value="<?php echo $VPosData['DIGITALSIGN'];?>">
<INPUT TYPE="hidden" NAME="SESSIONKEY" value="<?php echo $VPosData['SESSIONKEY'];?>">
<?php
echo '<p align="center"><b>',    __('WhenPressed'), '&ldquo;',    __('PayThisInvoice'), '&rdquo;, ',    __('PayInstructions4'), '</b></p>';
