<?php
$session = $this->request->session();
	$this->pageTitle= __('InvoiceRequestFrom', true).' '.$session->read('Company.CurrentName');
	$ThisInvoice = current($InvoiceQ);
	echo $this->Html-> css("nyroModal");
	echo $this->Html->script("nyroModal/nyroModal");
//localized validation code
	$TheJs = $session->read('LocaleCode').'/checkpay';
	echo $this->Html->script($TheJs);
	if($ThisInvoice['StatusID'] != 2){
		$ShowAuthCode = "yes"; include 'invoice.ctp';
		$this->Set('ClearSession', true);
	 }else{
	    if($_SESSION['Company']['CurrentCompanyID'] == 2){
	     $TheActionURL="/company/";
	   }
?>
<form name="TheForm" id="TheForm" method="post" action="<?php echo $TheActionURL ?>">
	<table border="0" align="center"width="850">
		<tr>
			<td colspan="4"><?php
			$ShowCedJur = "yes";
			include 'invoice.ctp';
			?></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:left"><?php
echo 'procesors' . DS . $session -> read('Company.Processor') . ".ctp";			
			require 'procesors' . DS . $session -> read('Company.Processor') . ".ctp";
			?></td>
		</tr>
		<tr>
			<th colspan="4">
				<?php
			//if ($session -> read('LocaleCode') == 'eng_us') {
			//	$TheLink = '/terms-and-conditions.htm';
			//} else {
			//	$TheLink = '/terminos-y-condiciones.htm';
			//}
				$TheLink = '/terms/';
				?>
			<input type="checkbox" value="OK" id="CheckTC" name="CheckTC">
			<a href="<?php echo $TheLink ?>" class="nyroModal" id="TC"><?php echo __('UndrestoodTS')
			?></a></th>
		</tr>
		<tr>
			<th colspan="4" align="center">
			<input type="image" name="Pay" id="Pay" width="266" height="42" alt="<?php echo __('PayThisInvoice')?>" src="/img/<?php echo strtolower(__('Pay', true))?>.gif">
			</th>
		</tr>
		<tr>
			<th colspan="4">&nbsp;</th>
		</tr>
		<tr>
			<td colspan="4" style="text-align:center"><?php
			if (strlen($session -> read('Company.Processor')) > 0) {
				echo $this -> element($session -> read('Company.Processor') . '_logos');
			}
			?></td>
		</tr>
	</table>
</form>
<?php }?>
