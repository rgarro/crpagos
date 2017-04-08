<?php
namespace App\Controller;

use Cake\Core\Configure;
use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Response Controller
 *
 * @property \App\Model\Table\ResponseTable $Response
 */
class ResponseController extends AppController {

  public function initialize(){
      parent::initialize();
      $this->loadModel('L10n');
      $this->loadModel('Vpos');
      $this->loadModel('Transactions');
      $this->loadModel('Invoices');
      $this->loadModel('Companies');
      //$this->loadComponent('Crypter');
  }

  function index() {
    $session = $this->request->session();
		$DemoMode = array(2);
		if (in_array($session -> read('Company.CurrentCompanyID'), $DemoMode) && isset($_POST['XMLREQ'])) {
			$VposResponse = array('authorizationResult' => '00', 'errorMessage' => 'Demo Ok', 'authorizationCode' => 'Demo Result');
			$lang = $session -> read('LocaleCode');
			$this -> L10n -> get($lang);
			Configure::write('Config.language', $lang);
			$this -> setAction('ResponseOK', $VposResponse);
		}

		//Check for The Response
		if (isset($_POST['XMLRES'])) {
			//Extract The Company Info using the IDCOMMERCE
			$CurrentCompany = current($this -> Companies -> index($_POST['IDCOMMERCE']));
			//We Should Have only One Record
			if ($CurrentCompany) {
				//Got Info, Get The Key Data to DeCrypt the XML
				$session -> write('Company.CurrentCompanyID', $CurrentCompany['Companies']['CompanyID']);
				$session -> write('Company.CurrentName', $CurrentCompany['Companies']['CompanyName']);
				$session -> write('Company.CurrentSubject', $CurrentCompany['Companies']['EmailSubject']);
				$session -> write('Company.CurrentLogo', $CurrentCompany['Companies']['Logo']);
				$session -> write('Company.CurrentURL', $CurrentCompany['Companies']['CompanyUrl']);
				$session -> write('Company.CurrentEmail', $CurrentCompany['Companies']['Email']);
				$session -> write('Company.CurrentBgColor', $CurrentCompany['Companies']['BgColor']);
				$session -> write('Company.CurrentBgImage', $CurrentCompany['Companies']['BgImage']);
				$session -> write('Company.CurrentName', html_entity_decode($CurrentCompany['Companies']['CompanyName'], ENT_NOQUOTES, 'iso-8859-1'));
				$session -> write('Company.CurrentInfo', html_entity_decode(nl2br($CurrentCompany['Companies']['CompanyInfo']), ENT_NOQUOTES, 'iso-8859-1'));
				$session -> write('Company.AcquirerID', $CurrentCompany['Companies']['AcquirerID']);
				$session -> write('Company.CommerceID', $CurrentCompany['Companies']['CommerceID']);
				$session -> write('Company.MallID', $CurrentCompany['Companies']['MallID']);
				$session -> write('Company.TerminalID', $CurrentCompany['Companies']['TerminalID']);
				$session -> write('Company.HexNumber', $CurrentCompany['Companies']['HexNumber']);
				$session -> write('Company.KeyName', $CurrentCompany['Companies']['KeyName']);
				$session -> write('VPOSResponse.XMLRES', $_POST['XMLRES']);
				$session -> write('VPOSResponse.DIGITALSIGN', $_POST['DIGITALSIGN']);
				$session -> write('VPOSResponse.SESSIONKEY', $_POST['SESSIONKEY']);
				$session -> write('VPOSResponse.IDACQUIRER', $_POST['IDACQUIRER']);
				$session -> write('VPOSResponse.IDCOMMERCE', $_POST['IDCOMMERCE']);
			} else {
				//**We couldn't get the CompanyID from the Response, Invalid $_POST['IDCOMMERCE']
				$this -> setAction("Error", "1");
			}
			//**We have all we need, DeCrypt it
			$VposResponse = $this -> Vpos -> ValidateResponse();
			if (is_array($VposResponse)) {
				//Update The Transaction
				$TransactionID = $VposResponse['purchaseOperationNumber'];
				$session -> write('TransactionID', $TransactionID);
				$this -> Transactions -> UpdateTransResponse($TransactionID, print_r($VposResponse, true));
				//Get the invoice from the special field, $VposResponse['reserved1']
				$CurrentInvoice = current($this -> Invoices -> GetInvoice($VposResponse['reserved1'], true));
				//Valid Number
				if ($CurrentInvoice) {
					//Set the other Localized Values
					$lang = $CurrentInvoice['Invoices']['LocaleCode'];
					$this -> L10n -> get($lang);
					Configure::write('Config.language', $lang);
					$session -> write('LocaleCode', $lang);
					$this -> Cookie -> write('lang', $lang, null, '+350 day');
					$session -> write('Company.PayURL', $CurrentInvoice['Companies']['CompanyUrl'] . strtolower(__('PayUrl', true)) . '/');
					$session -> write('Client.InvoiceID', $CurrentInvoice['Invoices']['InvoiceID']);
					$session -> write('User.FullName', $_SERVER['REMOTE_ADDR']);
					$this -> setAction("ResponseOK", $VposResponse);
				} else {
					//**Invalid Invoice using the Transaction info
					$this -> setAction("Error", 2);
				}
			} else {
				//**Invalid Response from Vpos
				$this -> setAction("Error", 3);
			}
		} else {
			//**No XML on Post
			$this -> setAction("Error", 4);
		}
		//End check Post
	}

	function ResponseOK($VposResponse = array()) {
    $session = $this->request->session();
		$InvoiceID = $session -> read('Client.InvoiceID');
		$Comment = __('VPOSReply', true) . ' Result ' . $VposResponse['authorizationResult'] . ' Message ' . $VposResponse['errorMessage'];
		//Do the Thingy
		if ($VposResponse['authorizationResult'] == '00') {
			//Read the InvoiceData from Session
			$this -> Invoices -> PayInvoice($InvoiceID, $VposResponse['authorizationCode'], $session -> read('TransactionID'));
			$Comment .= ' Auth # ' . $VposResponse['authorizationCode'];
			$this -> Invoices -> AddInvoiceLog($InvoiceID, 6, $Comment);
			$session -> setFlash("");
			//Requery to reflect new status
			$InvoiceQ = current($this -> Invoices -> index($InvoiceID));
			$InvoiceDetailQ = $this -> Invoices -> GetInvoiceDetail($InvoiceID);
			$Subject = __('TheInvoiceNumber', true) . ': ' . $InvoiceQ['Invoices']['InvoiceNumber'] . ' ' . __('ConfirmPaid', true);
			$_POST['CopyClient'] = 1;
			$TheTemplate = "invoicepaid";
			include VIEWS . 'company' . DS . 'mail.ctp';
		} else {
			//Save The Log
			$Comment = __('VPOSReply', true) . ' Result ' . $VposResponse['authorizationResult'] . ' Message ' . $VposResponse['errorMessage'];
			$this -> Invoices -> AddInvoiceLog($InvoiceID, 10, $Comment);
			$session -> setFlash(__('ErrorProcessingCard', true));
			$Subject = $session -> read('Company.CurrentName')." Error Processing Card : " . $TheError;
			$this -> SwiftMailer -> charset = "iso-8859-1";
			$this -> SwiftMailer -> from = "info@crpagos.com";
			$this -> SwiftMailer -> fromName = "CRPagos Error";
			$this -> SwiftMailer -> to = array('mensajes1@pragmatico.com' => 'Mensajes');
			//$this -> SwiftMailer -> cc = array('kchanto@pragmasoft.co.cr' => 'Kenneth');
			$this -> Set('VposResponse', $VposResponse);
			$this -> SwiftMailer -> sendAs = "text";
			if (!$this -> SwiftMailer -> send("invalid", $Subject)) {
				$this -> log('Error sending email ' . $Subject, LOG_ERROR);
			}
		}
		//Redirect

		$this -> redirect($session -> read('Company.PayURL'));
	}

	function Error($TheErrorCode) {
    $session = $this->request->session();
		switch($TheErrorCode) {
			case 1 :
				$TheError = "Got An Invalid IDCOMMERCE";
				break;
			case 2 :
				$TheError = "Invalid InvoiceID on XML";
				break;
			case 3 :
				$TheError = "Could not decrypt the response";
				break;
			case 4 :
				$TheError = "Got An Invalid Post with NOXML From " . (isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"unknown");
				break;
			default :
				$TheError = "Weird.. You sould't be reading this!";
				break;
		}

		//Update The Response
		$lang = $this -> Cookie -> read('lang');
		$this -> L10n -> get($lang);
		Configure::write('Config.language', $lang);
		$session -> write('LocaleCode', $lang);

		if ($session -> check('TransactionID')) {
			$this -> Transactions -> UpdateTransResponse($session -> read('TransactionID'), $TheError);
		}
		if ($session -> check('Client.InvoiceID')) {
			$InvoiceID = $session -> read('Client.InvoiceID');
			$this -> Invoices -> AddInvoiceLog($InvoiceID, 10, $TheError);
			$this -> Invoices -> UpdateInvoiceStatus($InvoiceID, 6);
		}
    /*****/
    $EmailSubject = $session -> read('Company.CurrentName')." Error Processing Card : " . $TheError;
    $Email = new Email('default');
    $Email->setCharset("iso-8859-1");
    //$Email->viewVars(array('Title'=>$EmailSubject));
    $Email->emailFormat('text');
    $Email->template("error_text");
    $Email->from(array('info@crpagos.com' => 'CRPagos Error'));
    $Email->replyTo(array("info@crpagos.com" => "InfoCRPagos"));
    $Email->cc(array('kchanto@pragmasoft.co.cr' => 'Kenneth'));
    $Email->subject($EmailSubject);
    $Email->to(array('mensajes1@pragmatico.com' => 'Mensajes'));
    //$Email->to(array('rgarro@gmail.com' => 'InfoCRPagos'));
    $Email->send();
    /*****/
		$this->Flash->error(__('BadError'));
		$this -> redirect('/' . __('ContactUsLink', true) . '.htm');
	}

}
