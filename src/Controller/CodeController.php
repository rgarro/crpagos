<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\L10n;

/**
 * Code Controller
 *
 * @property \App\Model\Table\CodeTable $Code
 */
class CodeController extends AppController
{
  public function initialize(){
      parent::initialize();
      //$this->loadModel('L10n');
      $this->loadModel('Invoices');
      $this->loadModel('Companies');
      $this->loadComponent('Crypter');
  }

  function  index($CompanyID =  null){
    $this->pageTitle= __('ManualPay', true);
    $session = $this->request->session();
    //$CompanyID = Sanitize::paranoid($CompanyID);
    if($CompanyID){
      $CurrentCompany = current($this->Companies->GetSites($CompanyID));//['Companies']
      $this->Set('CurrentName', $CurrentCompany['CompanyName'] );
      $this->Set('CurrentLogo', $CurrentCompany['Logo'] );
      $this->Set('CurrentURL', $CurrentCompany['CompanyUrl'] );
      $this->Set('CurrentBgColor', $CurrentCompany['BgColor'] );
      $this->Set('CurrentBgImage', $CurrentCompany['CompanyUrl'].$CurrentCompany['BgImage'] );
    }
//Check if there's a Code
    if(isset($_GET['CodigoFactura']) &&  strlen(trim($_GET['CodigoFactura'])) > 0){
      $TheInvoice = rawurldecode($_GET['CodigoFactura']);
    }elseif(
      isset($_GET['InvoiceCode']) && strlen(($_GET['InvoiceCode'])) > 0){
      $TheInvoice = rawurldecode($_GET['InvoiceCode']);
    }else{
      $TheInvoice = "";
    }
//Unecrypt It
    if(strlen(trim($TheInvoice)) > 0){
      $session->delete('Company');
      $session->delete('User');
      $session->delete('Client');
      $InvoiceID = $this->Crypter->deCrypt($TheInvoice);
      if(!is_numeric($InvoiceID)){
//Invalid Encryption
        $InvoiceID = 0;
      }
//Get it fom DB
      $InvoiceQ = $this->Invoices->GetInvoice($InvoiceID,true);
//Valid Number
      if(count($InvoiceQ) == 1){
        $CurrentCompany = current($InvoiceQ);
//Get The company info from Invoice
        $lang = $CurrentCompany['Invoices']['LocaleCode'];
        $this->L10n->get($lang);
        Configure::write('Config.language', $lang);
        $this->Session->write('LocaleCode', $lang);
        $this->Cookie->write('lang', $lang, null, '+350 day');
        $this->Session->write('Client.InvoiceID', $InvoiceID);
        $this->Session->write('User.FullName', $_SERVER['REMOTE_ADDR']);
        $this->Session->write('Company.CurrentCompanyID', $CurrentCompany['Companies']['CompanyID'] );
        $this->Session->write('Company.CurrentName', $CurrentCompany['Companies']['CompanyName'] );
        $this->Session->write('Company.CurrentSubject', $CurrentCompany['Companies']['EmailSubject'] );
        $this->Session->write('Company.CurrentLogo', $CurrentCompany['Companies']['Logo'] );
        $this->Session->write('Company.CurrentURL', $CurrentCompany['Companies']['CompanyUrl'] );
        $this->Session->write('Company.CurrentEmail', $CurrentCompany['Companies']['Email'] );
        $this->Session->write('Company.CurrentBgColor', $CurrentCompany['Companies']['BgColor'] );
        $this->Session->write('Company.CurrentBgImage', $CurrentCompany['Companies']['BgImage'] );
        $this->Session->write('Company.CurrentName', html_entity_decode($CurrentCompany['Companies']['CompanyName'],ENT_NOQUOTES,'iso-8859-1'));
        $this->Session->write('Company.CurrentInfo', html_entity_decode(nl2br($CurrentCompany['Companies']['CompanyInfo']),ENT_NOQUOTES,'iso-8859-1'));
        $this->Session->write('Company.PayURL',$CurrentCompany['Companies']['CompanyUrl'].strtolower(__('PayUrl', true)).'/');
        $Comment = __('InvoiceDisplayed', true).' '.$_SERVER['REMOTE_ADDR'];
//BNCR Stuff
        $this->Session->write('Company.AcquirerID', $CurrentCompany['Companies']['AcquirerID']);
        $this->Session->write('Company.CommerceID', $CurrentCompany['Companies']['CommerceID']);
        $this->Session->write('Company.MallID', $CurrentCompany['Companies']['MallID']);
        $this->Session->write('Company.TerminalID', $CurrentCompany['Companies']['TerminalID']);
        $this->Session->write('Company.HexNumber', $CurrentCompany['Companies']['HexNumber']);
        $this->Session->write('Company.KeyName', $CurrentCompany['Companies']['KeyName']);

        $this->Session->write('Company.Processor', $CurrentCompany['Companies']['Processor']);

        $this->Invoices->AddInvoiceLog($InvoiceID, 7, $Comment);
//Redirect to company's PayURL
        $this->redirect($this->Session->read('Company.PayURL'));
      }else{
//Invalid Number,  send to "Home"
        $this->layout = 'noheader';
        $this->Session->setFlash(__('NoneFound', true));
      }
    }else{
//No Code, send to "Home"
      $this->layout = 'noheader';
    }
  }

}
