<?php
	$this->SwiftMailer->charset = "iso-8859-1";
	$this->SwiftMailer->from = $this->Session->read('Company.CurrentEmail');
	$this->SwiftMailer->fromName = $this->Session->read('Company.CurrentName');
	if(isset($_POST['CopyClient'])){
		$Email = html_entity_decode(htmlspecialchars_decode($InvoiceQ['Clients']['Email']));
		$ClientName = html_entity_decode(htmlspecialchars_decode($InvoiceQ['Clients']['ClientName'].' '.$InvoiceQ['Clients']['ClientLastName']));
		$this->SwiftMailer->to = array($Email => $ClientName);
		$this->SwiftMailer->cc = array($this->Session->read('Company.CurrentEmail')=>$this->Session->read('Company.CurrentName'));
	}else{
		$this->SwiftMailer->to = array($this->Session->read('Company.CurrentEmail')=>$this->Session->read('Company.CurrentName'));
	}
	$ExtraCCs = $this->Session->read('Company.CurrentExtraCC');
	if(strlen($ExtraCCs) > 0){
		$ExtraCCs = explode(',', $ExtraCCs);
		$ExtraCCs =  array_fill_keys ($ExtraCCs, '');
		$this->SwiftMailer->cc = $ExtraCCs;
	}
	$this->SwiftMailer->bcc= array('mensajes1@pragmatico.com' => 'Mensajes');
	$ReplyTo = $this->Session->read('Company.CurrentReplyTo');
	if(strlen($ReplyTo) > 0){
		$this->SwiftMailer->replyTo = $ReplyTo;
	}else{
		$this->SwiftMailer->replyTo = $this->Session->read('Company.CurrentEmail');
	}

	$this->SwiftMailer->sendAs = "html";
	$this->pageTitle=  html_entity_decode($Subject,ENT_NOQUOTES,'iso-8859-1');
	$this->Set('ThisInvoice', $InvoiceQ);
	$this->Set('InvoiceDetailQ', $InvoiceDetailQ);
	if (!$this->SwiftMailer->send($TheTemplate, html_entity_decode($Subject,ENT_NOQUOTES,'iso-8859-1'))) {
		$this->log('Error sending email "register".', LOG_ERROR);
	}
?>