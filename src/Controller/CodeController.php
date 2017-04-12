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
      $this->loadComponent('Cookie');
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
        $session->write('LocaleCode', $lang);
        $this->Cookie->write('lang', $lang, null, '+350 day');
        $session->write('Client.InvoiceID', $InvoiceID);
        $session->write('User.FullName', $_SERVER['REMOTE_ADDR']);
        $session->write('Company.CurrentCompanyID', $CurrentCompany['Companies']['CompanyID'] );
        $session->write('Company.CurrentName', $CurrentCompany['Companies']['CompanyName'] );
        $session->write('Company.CurrentSubject', $CurrentCompany['Companies']['EmailSubject'] );
        $session->write('Company.CurrentLogo', $CurrentCompany['Companies']['Logo'] );
        $session->write('Company.CurrentURL', $CurrentCompany['Companies']['CompanyUrl'] );
        $session->write('Company.CurrentEmail', $CurrentCompany['Companies']['Email'] );
        $session->write('Company.CurrentBgColor', $CurrentCompany['Companies']['BgColor'] );
        $session->write('Company.CurrentBgImage', $CurrentCompany['Companies']['BgImage'] );
        $session->write('Company.CurrentName', html_entity_decode($CurrentCompany['Companies']['CompanyName'],ENT_NOQUOTES,'iso-8859-1'));
        $session->write('Company.CurrentInfo', html_entity_decode(nl2br($CurrentCompany['Companies']['CompanyInfo']),ENT_NOQUOTES,'iso-8859-1'));
        $session->write('Company.PayURL',$CurrentCompany['Companies']['CompanyUrl'].strtolower(__('PayUrl', true)).'/');
        $Comment = __('InvoiceDisplayed', true).' '.$_SERVER['REMOTE_ADDR'];
//BNCR Stuff
        $session->write('Company.AcquirerID', $CurrentCompany['Companies']['AcquirerID']);
        $session->write('Company.CommerceID', $CurrentCompany['Companies']['CommerceID']);
        $session->write('Company.MallID', $CurrentCompany['Companies']['MallID']);
        $session->write('Company.TerminalID', $CurrentCompany['Companies']['TerminalID']);
        $session->write('Company.HexNumber', $CurrentCompany['Companies']['HexNumber']);
        $session->write('Company.KeyName', $CurrentCompany['Companies']['KeyName']);

        $session->write('Company.Processor', $CurrentCompany['Companies']['Processor']);

        $this->Invoices->AddInvoiceLog($InvoiceID, 7, $Comment);
//Redirect to company's PayURL
        $this->redirect($session->read('Company.PayURL'));
      }else{
//Invalid Number,  send to "Home"
        $this->layout = 'noheader';
        $this->Flash(__('NoneFound', true));
      }
    }else{
//No Code, send to "Home"
      $this->layout = 'noheader';
    }
  }

}
