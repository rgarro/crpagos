<?php
namespace App\Controller;

use Cake\Core\Configure;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Core\App;
use App\Lib\L10n;

/**
 * Company Controller
 *
 * @property \App\Model\Table\CompanyTable $Company
 */
class CompanyController extends AppController
{

var $L10n;

  public function initialize(){
      parent::initialize();

      $this->loadModel("Users");
      $this->loadModel("Invoices");
      $this->loadModel("Clients");
      $this->loadModel("Currencies");
      $this->loadModel("Locales");
      $this->loadModel("Status");
      $this->loadComponent("Vpos");
      $this->loadModel("Transactions");
      //$this->loadHelper('Fecha');
      //$this->loadHelper('Paginator');
      $this->loadComponent("Crypter");

      //$this->loadModel('L10n');
      $this->loadModel('Users');
      $this->L10n = new L10n();
  }

  //el regimen se acabo ....
  public function index(){
    $session = $this->request->session();
    $_SESSION['CurrentCompanyID'] = $_SESSION['Company']['CurrentCompanyID'];
    if ($session -> read('Users.AccessLevel') == 0) {
			$this -> Set('UsersQ', $this -> Users -> GetUsers());
		}
		$this -> Set('ClientsQ', $this -> Clients -> index());
		if(isset($_GET['Sort'])){
			if($_GET['Sort'] == 'asc'){
				$TheSort = 'asc';
			}else{
				$TheSort = 'desc';
			}
		}else{
			$TheSort = 'desc';
		}
		if($TheSort == "desc" ){
			$this->Set('SortImage', 'desc.jpg');
			$this->Set('TheSort', 'desc');
			$this->Set('OtherSort','asc');
		}else{
			$this->Set('SortImage', 'asc.jpg');
			$this->Set('TheSort', 'asc');
			$this->Set('OtherSort','desc');
		}
		$this -> Set('InvoicesQ', $this -> Invoices -> index(null,null,null, $TheSort));
  }

  function indexb($ThisCompany = 0) {
    $session = $this->request->session();
    if(isset($_GET['currentCo'])){
      $ThisCompany = $_GET['currentCo'];
    }
		//Check if we're swtiching companies
		if ($session -> read('Company.CurrentCompanyID') != $ThisCompany) {
			$session -> write('Company.CurrentCompanyID', $ThisCompany);
			foreach ($session->read('Companies') as $CurrentCompany) {
				if ($CurrentCompany['CompanyID'] == $ThisCompany) {
					//If Access OK, set the variables
					$session -> write('Company.CurrentSubject', $CurrentCompany['EmailSubject']);
					$session -> write('Company.CurrentLogo', $CurrentCompany['Logo']);
					$session -> write('Company.CurrentURL', $CurrentCompany['CompanyUrl']);
					$session -> write('Company.CurrentCompanyURL', $CurrentCompany['CompanyUrl']);
					$session -> write('Company.CurrentEmail', $CurrentCompany['Email']);
					$session -> write('Company.CurrentReplyTo', $CurrentCompany['ReplyTo']);
					$session -> write('Company.CurrentExtraCC', $CurrentCompany['ExtraCC']);
					$session -> write('Company.CurrentName', html_entity_decode($CurrentCompany['CompanyName'], ENT_NOQUOTES, 'iso-8859-1'));
					$session -> write('Company.CurrentInfo', html_entity_decode(nl2br($CurrentCompany['CompanyInfo']), ENT_NOQUOTES, 'iso-8859-1'));
					$session -> write('Company.CurrentDefaultNote', html_entity_decode(nl2br($CurrentCompany['DefaultNote']), ENT_NOQUOTES, 'iso-8859-1'));
					$AccessOK = "yes";
					break;
				}
			}

			//If No Access, redirect to last used
			if (!isset($AccessOK)) {
        //echo "herebbbb";
//echo $session -> read('Company.CurrentURL');
				//$this -> redirect($session -> read('Company.CurrentURL'));
				//exit();
			}
		}
		//If user is Admin, get the user's data
		if ($session -> read('Users.AccessLevel') == 0) {
			$this -> Set('UsersQ', $this -> Users -> GetUsers());
		}
		$this -> Set('ClientsQ', $this -> Clients -> index());
		if(isset($_GET['Sort'])){
			if($_GET['Sort'] == 'asc'){
				$TheSort = 'asc';
			}else{
				$TheSort = 'desc';
			}
		}else{
			$TheSort = 'desc';
		}
		if($TheSort == "desc" ){
			$this->Set('SortImage', 'desc.jpg');
			$this->Set('TheSort', 'desc');
			$this->Set('OtherSort','asc');
		}else{
			$this->Set('SortImage', 'asc.jpg');
			$this->Set('TheSort', 'asc');
			$this->Set('OtherSort','desc');
		}
		$this -> Set('InvoicesQ', $this -> Invoices -> index(null,null,null, $TheSort));
	}

	//Set The New Invoice Form
	function NewInvoice() {
		$this -> Set('LocalesQ', $this -> Locales -> index());
		$this -> Set('ClientsQ', $this -> Clients -> index());
		$this -> Set('CurrencyQ', $this -> Currencies -> index());
		$this -> Set('InvoiceLogQ', array());
	}

	//Function  for AJAX insert
	function QuickAddClient() {
		Configure::write('debug', 0);
		$SafeMail = trim($_POST['Email']);
		$TheSafeName = trim($_POST['ClientName'] . ' ' . $_POST['ClientLastName']) . ' (' . $SafeMail . ')';
		// Uncomment this if would like to check cllient by email
		//		$Check = $this->Clients->FindClientByEmail($SafeMail);
		//		if(count($Check) <> 0){
		//			$ClientID = $Check['0']['Clients']['ClientID'];
		//			$this->Clients->UpdateClient($ClientID);
		//		}else{
		$ClientID = $this -> Clients -> AddClient();
		//		}
		$Result = array('ClientID' => $ClientID, 'ClientName' => $TheSafeName);
		echo json_encode($Result);
		exit;
	}

	//Edit Invoice
	function EditInvoice($InvoiceID = null) {
    $session = $this->request->session();
		$InvoiceID = base64_decode($InvoiceID);
		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));
		if ($this -> viewVars['InvoiceQ'][0]['StatusID'] != 1) {
			$this -> redirect('/company/viewinvoice/' . base64_encode($InvoiceID) . '/');
			exit();
		}
		$this -> Set('LocalesQ', $this -> Locales -> index());
		$this -> Set('ClientsQ', $this -> Clients -> index());
		$this -> Set('CurrencyQ', $this -> Currencies -> index());
		$this -> Set('StatusQ', $this -> Status -> index());
		//Use Selected Language IF Any
		if (!isset($_GET['Lang'])) {
			$lang = $this -> viewVars['InvoiceQ'][0]['LocaleCode'];
			$this -> L10n -> get($lang);
			Configure::write('Config.language', $lang);
		}
    $ivq = $this -> Invoices -> GetInvoiceDetail($InvoiceID);
		$this -> Set('InvoiceDetailQ', $ivq);
		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
	}

	//View Invoice
	function ViewInvoice($InvoiceID = null) {
    $session = $this->request->session();
		$InvoiceID = base64_decode($InvoiceID);
		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));
		$this -> Set('InvoiceDetailQ', $this -> Invoices -> GetInvoiceDetail($InvoiceID));
		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
		$this -> Set('LocalesQ', $this -> Locales -> index());
		$this -> Set('StatusQ', $this -> Status -> index($this -> viewVars['InvoiceQ'][0]['StatusID']));
	}

	//Void Invoice
	function VoidInvoice($InvoiceID = null) {
    $session = $this->request->session();
		$InvoiceID = base64_decode($InvoiceID);
		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));
		if ($this -> viewVars['InvoiceQ'][0]['Invoices']['StatusID'] < 2) {
			$this -> redirect('/company/viewinvoice/' . base64_encode($InvoiceID) . '/');
			exit();
		}
		$this -> Set('InvoiceDetailQ', $this -> Invoices -> GetInvoiceDetail($InvoiceID));
		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
		$this -> Set('LocalesQ', $this -> Locales -> index());
		$this -> Set('StatusQ', $this -> Status -> index($this -> viewVars['InvoiceQ'][0]['StatusID']));
	}

	//pay Invoice
	function PayInvoice($InvoiceID = null) {
$session = $this->request->session();
		$InvoiceID = base64_decode($InvoiceID);
		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));
		if ($this -> viewVars['InvoiceQ'][0]['StatusID'] < 2) {
			$this -> redirect('/company/viewinvoice/' . base64_encode($InvoiceID) . '/');
			exit;
		}
		$this -> Set('InvoiceDetailQ', $this -> Invoices -> GetInvoiceDetail($InvoiceID));
		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
		$this -> Set('LocalesQ', $this -> Locales -> index());
		$this -> Set('StatusQ', $this -> Status -> index($this -> viewVars['InvoiceQ'][0]['StatusID']));
	}

	//Save Invoice
	function SaveInvoice() {
		$Flash = __('UpdatedFlash', true);
		$ActionID = 0;
		if (isset($_POST['InvoiceID'])) {
			//Update Invoice
			$InvoiceID = base64_decode($_POST['InvoiceID']);
			if (isset($_POST['Comment'])) {$TheComment = $_POST['Comment'];
			} else {$TheComment = null;
			}
			if (!isset($_POST['RefNumber'])) {$_POST['RefNumber'] = '';
			}
			switch($_POST['StatusID'] ) {
				//PaidManually
				case 4 :
					$ActionID = 8;
					$Redirect = "Yes";
					$Flash = __('PaidManuallyFlash', true);
					break;
				//Void
				case 5 :
					$ActionID = 9;
					$Redirect = "Yes";
					$Flash = __('VoidedInvoiceFlash', true);
					break;
				//Just Update
				default :
					$ActionID = 2;
					$Flash = __('UpdatedFlash', true);
					break;
			}
			//Update DB
			$this -> Invoices -> UpdateInvoice($InvoiceID);
			$this -> Invoices -> AddInvoiceLog($InvoiceID, $ActionID, $TheComment);
		} else {
			//Add New Invoice
			$InvoiceID = $this -> Invoices -> AddInvoice();
			if (isset($_POST['Comment'])) {$TheComment = $_POST['Comment'];
			} else {$TheComment = null;
			}
			$this -> Invoices -> AddInvoiceLog($InvoiceID, 1, $TheComment);
		}
		//Save Lines
		if (isset($_POST['Qty'])) {
			$this -> Invoices -> DeleteInvoiceDetail($InvoiceID);
			$i = 0;
			foreach ($_POST['Qty'] as $ThisDetailQ) {
				$Qty = $ThisDetailQ;
				if (is_numeric($Qty)) {
					$Description = $_POST['Desc'][$i];
					$UnitPrice = $_POST['UnitPrice'][$i];
					if (!is_numeric($UnitPrice)) {$UnitPrice = 0;
					}
					$Amount = $_POST['Amount'][$i];
					if (!is_numeric($Amount)) {$Amount = 0;
					}
					$this -> Invoices -> AddInvoiceDetail($InvoiceID, $Qty, $Description, $UnitPrice, $Amount);
				}
				$i++;
			}
		}
		//Send Emails if Any Here
		if ($ActionID == 8) {
			$InvoiceQ = current($this -> Invoices -> index($InvoiceID));
			$InvoiceDetailQ = $this -> Invoices -> GetInvoiceDetail($InvoiceID);
			$Subject = __('TheInvoiceNumber', true) . ': ' . $InvoiceQ['InvoiceNumber'] . ' ' . __('ConfirmManualPaid', true);
			$TheTemplate = "invoicepaid";
			require VIEWS . 'company' . DS . 'mail.ctp';
		}
		if ($ActionID == 9) {
			$InvoiceQ = current($this -> Invoices -> index($InvoiceID));
			$InvoiceDetailQ = $this -> Invoices -> GetInvoiceDetail($InvoiceID);
			$Subject = __('TheInvoiceNumber', true) . ': ' . $InvoiceQ['InvoiceNumber'] . ' ' . __('ConfirmVoid', true);
			$TheTemplate = "invoicepaid";
			require VIEWS . 'company' . DS . 'mail.ctp';
		}
		//Before redirect to assure it'll get set
		$this->Flash->success($Flash);
		if (isset($Redirect)) {
			$this -> redirect('/company/viewinvoice/' . base64_encode($InvoiceID) . '/');
			exit;
		}
		//Query the DB	to reflect new changes
		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));
		$this -> Set('InvoiceDetailQ', $this -> Invoices -> GetInvoiceDetail($InvoiceID));
		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
	}

	//Send Emails
	function SendMail() {
    $session = $this->request->session();
		$SentTo = array();
		foreach ($_POST['InvoiceID'] as $ThisInvoice) {
			$InvoiceID = base64_decode($ThisInvoice);
			$InvoiceQ = current($this -> Invoices -> index($InvoiceID));
			$InvoiceDetailQ = $this -> Invoices -> GetInvoiceDetail($InvoiceID);
			if (count($this -> Invoices -> GetInvoiceLog($InvoiceID, 3)) == 0) {
				$ActionID = 3;
			} else {
				$ActionID = 4;
			}
			if (isset($_POST['Coment'])) {
				$Comment = $_POST['Coment'];
			} else {
				$Comment = __('BatchResend', true);
			}
			$this -> Invoices -> UpdateInvoiceStatus($InvoiceID, 2);
			$this -> Invoices -> AddInvoiceLog($InvoiceID, $ActionID, $Comment);
			//Email Goes Here
			$Subject = $InvoiceQ['EmailSubject'] . '. ' . __('InvoiceNumber', true) . ': ' . $InvoiceQ['InvoiceNumber'];
			$TheTemplate = "invoice_html";
			$this -> Set('ThisInvoice', $InvoiceQ);
			$this -> Set('InvoiceDetailQ', $InvoiceDetailQ);
			$this -> Set('TheCode', rawurlencode($this -> Crypter -> enCrypt($InvoiceID)));
			//Force Client Copy
			$_POST['CopyClient'] = 1;

      require  getcwd().'/src/Template/Company/mail.ctp';
			$SentTo[] = $InvoiceQ['ClientName'] . ' ' . $InvoiceQ['ClientLastName'] . '(' . $InvoiceQ['Email'] . ') ' . __('InvoiceNumber', true) . ': ' . $InvoiceQ['InvoiceNumber'] . ' ' . __('Amount', true) . ':' . $InvoiceQ['CurrencySymbol'] . number_format($InvoiceQ['TheTotal'], 2);
		}
		$this -> Set('SentTo', $SentTo);
		$HowMany = count($SentTo);
		if ($HowMany == 1) {
			$Flash = __('OneMailSent', true);
		} else {
			$Flash = $HowMany . ' ' . __('MailSent', true);
		}
		$this -> Flash->success($Flash);
	}

	function Pay() {
    $session = $this->request->session();
		$this -> layout = 'noheader';

		//Read the InvoiceData from Session
		$InvoiceID = $session -> read('Client.InvoiceID');
		//Read the InvoiceData from DB
		$InvoiceQ = $this -> Invoices -> index($InvoiceID, 1);

		//Prepare the values for the VPOS plugin only if not paid
		if (count($InvoiceQ) > 0 && $InvoiceQ[0]['StatusID'] == 2) {
			$Amount = $InvoiceQ[0][0]['TheTotal'];
			$InvoiceNumber = $InvoiceQ[0]['InvoiceNumber'];
			$VposCurCode = $InvoiceQ[0]['VPOSCurCode'];
			$VposLocaleCode = $InvoiceQ[0]['VPOSLangCode'];
			$ClientName = substr($InvoiceQ[0]['ClientName'], 0, 30);
			$ClientLastName = substr($InvoiceQ[0]['ClientLastName'],0, 50);
			$ClientEmail = substr($InvoiceQ[0]['Email'],0, 50);
			$ClientPhone = substr($InvoiceQ[0]['Phone'],0, 15);
			$session->write('Client.ClientName', $ClientName);
			$session->write('Client.ClientLastName', $ClientLastName);
			$session->write('Client.ClientEmail', $ClientEmail);

			//Get the  new TransactionID
			$TransactionID = $this -> Transactions -> AddTransaction();
			$session -> write('TransactionID', $TransactionID);
			$session -> write('Amount', $Amount);
			$session -> write('Currency', $VposCurCode);

			Switch ($session -> read('Company.Processor')) {
			//Credomatic Cardinal
				case 'cardinal':
				$this->Set('TheActionURL', '/pay-invoice/');
				break;

			//Credomatic PayCom
				case 'paycom':

				break;
				default:
				//BNCR untill we have more
				//Call The VPOS Plugin
				if (strrchr($_SESSION['Company']['KeyName'], '.') == '.TESTING') {
					$this->Set('TheActionURL',"https://preprod.verifika.com/VPOS/MM/transactionStart20.do");
				} else {
					$this->Set('TheActionURL',"https://vpayment.verifika.com/VPOS/MM/transactionStart20.do");
				}
				if ($_SESSION['Company']['CurrentCompanyID'] == 2) {
					$this->Set('TheActionURL', "/company/");
				}
			//if ($_SESSION['Company']['CurrentCompanyID'] == 6) {
			//	$this->Set('TheActionURL', "/intercontinental/");
			//}
				$TheVposData = $this->Vpos->initialize($InvoiceID, $Amount, $TransactionID, $VposCurCode, $VposLocaleCode, $ClientName, $ClientLastName, $ClientEmail );
				//Set The View's Variables
					$this->Set('VPosData', $TheVposData);
				break;
			}

		}
		$this -> Set('InvoiceQ', $InvoiceQ);
		$this -> Set('InvoiceDetailQ', $this -> Invoices -> GetInvoiceDetail($InvoiceID));
	}

	//Spanish Alias
	function Pagar() {
		$this -> setAction('Pay');
	}

	function Delete() {
    $session = $this->request->session();
		$SentTo = array();
		foreach ($_POST['InvoiceID'] as $ThisInvoice) {
			$InvoiceID = base64_decode($ThisInvoice);
			$this -> Invoices -> DeleteInvoice($InvoiceID);
			$Comment = __('DeletedInvoice', true);
		}
		$HowMany = count($_POST['InvoiceID']);
		if ($HowMany == 1) {
			$Flash = __('InvoiceDeleted', true);
		} else {
			$Flash = $HowMany . ' ' . __('InvoicesDeleted', true);
		}
		$this ->Flash->success($Flash);
		$this -> redirect($session -> read('Company.CurrentURL'));

	}

	function Search(){
    $session = $this->request->session();
		if(count($_POST) > 0){
			$TheQuery = null;

			$InvoiceNumber = trim($_POST['InvoiceNumber']);
			$ClientName = trim($_POST['ClientName']);
			$ClientLastName = trim($_POST['ClientLastName']);
			$Email = trim($_POST['Email']);

			if(strlen($InvoiceNumber) > 0){
				$TheQuery .= " AND InvoiceNumber = '".$InvoiceNumber."'";
			}
			if(strlen($ClientName) > 0){
				$TheQuery .= " AND ClientName LIKE '%".$ClientName."%'";
			}
			if(strlen($ClientLastName) > 0){
				$TheQuery .= " AND ClientLastName LIKE '%".$ClientLastName."%'";
			}
			if(strlen($Email) > 0){
				$TheQuery .= " AND Email LIKE '%".$Email."%'";
			}

			if(!is_null($TheQuery)){
				$InvoicesQ = $this -> Invoices -> index(null, null, $TheQuery);
				$RecordCount = count($InvoicesQ);
				if($RecordCount == 0){
					$this -> Flash->success(__('NoRecordsFound'));
					$this -> redirect($session -> read('Company.CurrentURL').'#tabs-search');
				}else{
					if($RecordCount == 1){
						$TheFlash = __('Found1Record');
					}else{
						$TheFlash = __('Found', true).' '.$RecordCount.' '.__('Records');
					}
					$this -> Flash->success($TheFlash);
					$this -> Set('InvoicesQ', $InvoicesQ);
					$this->render('index');
				}
			}else{
				$this -> Flash->success(__('NothingToSearch'));
				$this -> redirect($session -> read('Company.CurrentURL'));
			}
		}else{
			$this -> Flash->success(__('NothingToSearch'));
			$this -> redirect($session -> read('Company.CurrentURL').'#tabs-search');
		}

	}

}
