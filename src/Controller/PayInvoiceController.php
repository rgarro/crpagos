<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\L10n;
use Cake\Mailer\Email;
/**
 * PayInvoice Controller
 *
 * @property \App\Model\Table\PayInvoiceTable $PayInvoice
 */
class PayInvoiceController extends AppController
{

  var $L10n;

  public function initialize(){
      parent::initialize();
      $this->loadModel('Invoices');
      $this->loadModel('Transactions');
      $this->loadHelper('Fecha');
      $this->loadHelper('Paginator');
      $this->loadComponent('Cardinal');
      $this->loadComponent('Paycom');
      //$this->L10n = new L10n();
  }

  function index() {
    $session = $this->request->session();
		$LocalIps = array('127.0.0.1', '192.168.1.52');
		$UseProcessor = $session -> read('Company.Processor');

		if (count($_POST) > 0) {
			//Process Card Data
			$CCNumber = $_POST['CCNumber'];
			$CCMask = substr($CCNumber, -4);
			$session -> write('CardData.CCMask', 'XXXX-XXXX-XXXX-' . $CCMask);
			$CCExp = $_POST['CCExp'];
			$session -> write('CardData.CCExp', $CCExp);
			$CCHolder = $_POST['CCHolder'];
			$session -> write('CardData.CCHolder', $CCHolder);
			$CVV = $_POST['CVV'];
			$session -> write('CardData.CVV', $CVV);
			$Currency = $session -> read('Currency');

			//Check if the TOS is checked
			if (!isset($_POST['CheckTC'])) {
				$this -> Flash->error(__('MustAcceptTOS', true));
				$this -> redirect($session -> read('Company.PayURL'), '301 Moved Permanently');
				exit ;
			}
			$TheTotal = number_format($session -> read('Amount') / 100, 2, ".", "");

			$TransactionID = $session -> read('TransactionID');

			$InvoiceID = $session -> read('Client.InvoiceID');


			//validation($CCNumber, $CCExp, $CredomaticAmt, $CVV, $Currency = 840)
			$ValidationResult = $this -> $UseProcessor -> validation($CCNumber, $CCExp, $TheTotal, $CVV, $Currency);

			$session -> write('CardData.CCType', $this -> $UseProcessor -> CCType);

			if ($ValidationResult) {
				$this -> $UseProcessor -> ClientName =   $session->read('Client.ClientName');
				$this -> $UseProcessor -> ClientLastName = $session->read('Client.ClientLastName');
				$this -> $UseProcessor -> ClientEmail = $session->read('Client.ClientEmail');

				//Go thru appoval
				//but not for Localhost
				//if (in_array($_SERVER['SERVER_ADDR'], $LocalIps)) {
					//temphash
					//$DummyTime = time();
					//Prepare the MD5 string
					//$DummyHash = MD5($InvoiceID . "|" . $TheTotal . "|1|" . $TransactionID . "|U|P|" . $DummyTime . "|" . $this -> cardinal -> Key);
					//Do The Hash
					//$RedirectTo = "Location: " . $this -> $UseProcessor -> UrlToRedirect . "?response=1&responsetext=Dummy+ Local+Auth&authcode=123&transactionid=" . $TransactionID . "&avsresponse=U&cvvresponse=P&orderid=" . $InvoiceID . "&type=auth=123&response_code=200&username=2729323&time=" . $DummyTime . "&amount=" . $TheTotal . "&hash=" . $DummyHash . "\n";
				//} else {
					//Do the thingy
					$RedirectTo = $this -> $UseProcessor -> process($InvoiceID);
				//}
				//End Validation true
				//Redirect wherever
				header("HTTP/1.1 301 Moved Permanently");
				header($RedirectTo);
				exit ;
			}
			//did not pass validation
			$this -> setAction("Error", 4);
			$this ->Flash->error($this -> $UseProcessor -> errmsg);
			$this -> redirect($session -> read('Company.PayURL'), '301 Moved Permanently');

		} else {

			$this -> setAction('GetResponse');

		}

	}

	function GetResponse() {
    $session = $this->request->session();
		$UseProcessor = $session -> read('Company.Processor');
		$TheTotal = number_format($session -> read('Amount') / 100, 2, ".", "");
		$TransactionID = $session -> read('TransactionID');
		$InvoiceID = $session -> read('Client.InvoiceID');

		$session -> delete('TheTotal');
		//Only the URL
		if (count($_GET) == 1) {
			//No response from server
			$this -> setAction("Error", 3);
		} else {
			if ($this -> $UseProcessor -> checkhash($_GET["hash"], $_GET["orderid"], $_GET["amount"], $_GET["response"], $_GET["transactionid"], $_GET["avsresponse"], $_GET["cvvresponse"], $_GET["time"])) {
				//Valid Response from Credomatic
				if ($_GET["response"] == 1) {
					//Credmonatic said OK
					$Comment = __('VPOSReply', true) . ' Result ' . $_GET['response_code'] . ' Message ' . $_GET['responsetext'];
					$this -> Transactions -> UpdateTransResponse($session -> read('TransactionID'), print_r($_GET, true));
					//Read the InvoiceData from Session
					$this -> Invoices -> PayInvoice($InvoiceID, $_GET['authcode'], $session -> read('TransactionID'));
					$Comment .= ' Auth # ' . $_GET['authcode'];
					$Comment .= ' ' . print_r($_GET, true);
					$this -> Invoices -> AddInvoiceLog($InvoiceID, 6, $Comment);
					$this -> Flash->error("");
					//Requery to reflect new status
					$InvoiceQ = current($this -> Invoices -> index($InvoiceID));
					$InvoiceDetailQ = $this -> Invoices -> GetInvoiceDetail($InvoiceID);
					$Subject = __('TheInvoiceNumber', true) . ': ' . $InvoiceQ['InvoiceNumber'] . ' ' . __('ConfirmPaid', true);
					$_POST['CopyClient'] = 1;
					$TheTemplate = "invoicepaid";
					require getcwd(). '/src/Template/Company/mail.ctp';
					$this -> redirect($session -> read('Company.PayURL'), '301 Moved Permanently');
					exit ;
				} else {
					//Save the error on Flash
					$this -> setAction("Error", 1);
					$this -> Flash->error($_GET['responsetext']);
				}
			} else {
				//Bad Hash Store the transaction
				$this -> setAction("Error", 2);
			}
		}
	}

	function Error($TheErrorCode) {
    $session = $this->request->session();
		switch($TheErrorCode) {
			case 1 :
				$TheError = "Card Denied";
				break;
			case 2 :
				$TheError = "Bad Hash";
				break;
			case 3 :
				$TheError = " No response From Server ";
				break;
			case 4 :
				$TheError = " Invalid Credit Card Number ";
				break;
			default :
				$TheError = "Weird.. You sould't be reading this!";
				break;
		}

		//Update The Response
		$lang = $this -> Cookie -> read('lang');
		//$this -> L10n -> get($lang);
		Configure::write('Config.language', $lang);
		$session -> write('LocaleCode', $lang);

		if ($session -> check('TransactionID')) {
			$this -> Transactions -> UpdateTransResponse($session -> read('TransactionID'), $TheError . ' ' . print_r($_GET, true));
		}
		if ($session -> check('Client.InvoiceID')) {
			$InvoiceID = $session -> read('Client.InvoiceID');
			$this -> Invoices -> AddInvoiceLog($InvoiceID, 6, $TheError . print_r($_GET, true));
		}

    $EmailSubject =$session -> read('Company.CurrentName')." Credomatic Error Processing Card : " . $TheError;
    $Email = new Email('default');
    $Email->setCharset("iso-8859-1");
    //$Email->viewVars(array('UserQ'=>$UserQ));
    $Email->emailFormat('text');
    $Email->template("error_text");
    $Email->from(array('info@crpagos.com' => 'CRPagos Error'));
    $Email->replyTo(array("info@crpagos.com" => "CRPagos Error"));
    $Email->cc(array('kchanto@pragmasoft.co.cr' => 'Kenneth'));
    $Email->subject($EmailSubject);
    $Email->to(array('mensajes1@pragmatico.com' => 'Mensajes'));
    //$Email->to(array('rgarro@gmail.com' => 'InfoCRPagos'));
    $Email->send();

		$this -> Flash->error(__('ErrorProcessingCard', true));
		$this -> redirect($session -> read('Company.PayURL'), '301 Moved Permanently');
		exit ;
	}
}
