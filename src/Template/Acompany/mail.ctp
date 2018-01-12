<?php
use Cake\Mailer\Email;

$session = $this->request->session();


//$EmailSubject .=" # ".date("F j, Y, g:i a");
$Email = new Email('default');
$Email->setCharset("iso-8859-1");

if(isset($_POST['CopyClient']) || isset($_GET['invoice_id'])){
	$Emailb = html_entity_decode(htmlspecialchars_decode($InvoiceQ['Email']));
	$ClientName = html_entity_decode(htmlspecialchars_decode($InvoiceQ['ClientName'].' '.$InvoiceQ['ClientLastName']));
	$Email->to(array($Emailb => $ClientName));
	$Email->cc(array($session->read('Company.CurrentEmail')=>$session->read('Company.CurrentName')));
}else{
	$Email->to(array($session->read('Company.CurrentEmail')=>$session->read('Company.CurrentName')));
}
$ExtraCCs = $session->read('Company.CurrentExtraCC');
if(strlen($ExtraCCs) > 0){
	$ExtraCCs = explode(',', $ExtraCCs);
	$ExtraCCs =  array_fill_keys ($ExtraCCs, '');
	$Email->cc($ExtraCCs);
}
$Email->cc(array('mensajes1@pragmatico.com' => 'Mensajes'));
$ReplyTo = $session->read('Company.CurrentReplyTo');
if(strlen($ReplyTo) > 0){
	//$Email->replyTo($ReplyTo);
	$Email->replyTo($session->read('Company.CurrentEmail'));
}else{
	$Email->replyTo($session->read('Company.CurrentEmail'));
}


$this->pageTitle=  html_entity_decode($Subject,ENT_NOQUOTES,'iso-8859-1');
$Email->viewVars(['ThisInvoice'=> $InvoiceQ,'InvoiceDetailQ'=> $InvoiceDetailQ,"TheCode"=>$TheCode]);

//$Email->viewVars(array('Title'=>$EmailSubject));
$Email->emailFormat('html');
$Email->template($TheTemplate);
$Email->from(array($session->read('Company.CurrentEmail') => $session->read('Company.CurrentName')));
$Email->replyTo($session->read('Company.CurrentEmail'));
//$Email->replyTo(array("info@nicapagos.com" => "NicaPagos"));

$Email->subject($Subject);

$res = $Email->send();
