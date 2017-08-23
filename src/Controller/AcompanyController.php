<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Core\App;
use App\Lib\L10n;

class AcompanyController extends AppController
{

  public function initialize(){
      parent::initialize();
      $session = $this->request->session();
      I18n::locale($session->read('LocaleCodeb'));
      $this->loadModel('Clients');
      $this->loadModel("Invoices");
      $this->loadModel('Companies');
      $this->loadComponent('RequestHandler');
      $this->loadModel("Users");
      $this->loadModel("Currencies");
      $this->loadModel("Locales");
      $this->loadModel("Status");
      $this->loadComponent("Vpos");
      $this->loadModel("Transactions");
      $this->loadComponent("Crypter");
  }


    public function index()
    {
      if((isset($_GET['company_id']) && is_numeric($_GET['company_id'])) && (isset($_GET['status_id']) && is_numeric($_GET['status_id']))){
        $this->viewBuilder()->setLayout('ajax');
        $invoices = $this->Invoices->allByCompanyIDAndStatusID($_GET['company_id'],$_GET['status_id']);
        $this->set('invoices',$invoices);
        $this->set('status_id',$_GET['status_id']);
      }else{
        throw new Exception("Must GET a numeric company_id and status_id.");
      }
    }

    public function viewvoidinvoice(){
      $this->viewBuilder()->setLayout('ajax');
      $session = $this->request->session();
      $InvoiceID = $_GET['invoice_id'];
  		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));

  		if ($this -> viewVars['InvoiceQ'][0]['StatusID'] < 2) {
  			$this -> redirect('/company/viewinvoice/' . base64_encode($InvoiceID) . '/');
  			exit();
  		}
  		$this -> Set('InvoiceDetailQ', $this -> Invoices -> GetInvoiceDetail($InvoiceID));
  		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
  		$this -> Set('LocalesQ', $this -> Locales -> index());
  		$this -> Set('StatusQ', $this -> Status -> index($this -> viewVars['InvoiceQ'][0]['StatusID']));
    }

    public function viewpayinvoice(){
      $this->viewBuilder()->setLayout('ajax');
      $session = $this->request->session();
      $InvoiceID = $_GET['invoice_id'];
  		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));
  		/*if ($this -> viewVars['InvoiceQ'][0]['StatusID'] < 2) {
  			$this -> redirect('/company/viewinvoice/' . base64_encode($InvoiceID) . '/');
  			exit;
  		}*/
  		$this -> Set('InvoiceDetailQ', $this -> Invoices -> GetInvoiceDetail($InvoiceID));
  		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
  		$this -> Set('LocalesQ', $this -> Locales -> index());
  		$this -> Set('StatusQ', $this -> Status -> index($this -> viewVars['InvoiceQ'][0]['StatusID']));
    }

    public function editinvoice(){
      $this->viewBuilder()->setLayout('ajax');
      $session = $this->request->session();
      $InvoiceID = $_GET['invoice_id'];
  		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));

  		$this -> Set('LocalesQ', $this -> Locales -> index());
  		$this -> Set('ClientsQ', $this -> Clients -> index());
  		$this -> Set('CurrencyQ', $this -> Currencies -> index());
  		$this -> Set('StatusQ', $this -> Status -> index());
  		//Use Selected Language IF Any

      $ivq = $this -> Invoices -> GetInvoiceDetail($InvoiceID);
  		$this -> Set('InvoiceDetailQ', $ivq);
  		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
    }

    public function viewinvoice(){
      $this->viewBuilder()->setLayout('ajax');
      $session = $this->request->session();
  		$InvoiceID = $_GET['invoice_id'];
  		$this -> Set('InvoiceQ', $this -> Invoices -> index($InvoiceID));
  		$this -> Set('InvoiceDetailQ', $this -> Invoices -> GetInvoiceDetail($InvoiceID));
  		$this -> Set('InvoiceLogQ', $this -> Invoices -> GetInvoiceLog($InvoiceID));
  		$this -> Set('LocalesQ', $this -> Locales -> index());
  		$this -> Set('StatusQ', $this -> Status -> index($this -> viewVars['InvoiceQ'][0]['StatusID']));
    }

    public function save(){
        $session = $this->request->session();
        if(isset($_GET['CompanyID']) && is_numeric($_GET['CompanyID'])){
          $company = $this->Companies->get($_GET['CompanyID'],['contain' => []]);
        }else{
          $company = $this->Companies->newEntity();
        }
        $cia = $this->Companies->patchEntity($company,$_GET);
        if ($this->Companies->save($cia)) {
            $flash = __('The Company has been saved.');
            $success = 1;
            $invalid_form = 0;
            $errors = [];
        }else{
          $success = 0;
          $flash = __('The Company could not be saved. Please, try again.');
          $invalid_form = 1;
          $errors = $cia->errors();
        }
        $this->set('__serialize',["is_success"=>1,"flash"=>$flash,"invalid_form"=>$invalid_form,"error_list"=>$errors]);
    }

    public function saveinvoice(){
      $session = $this->request->session();
      //$this->viewBuilder()->setLayout('ajax');
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
  			$TheTemplate = "invoicepaid_html";
  			require current(App::path("Template")). '/Company' . DS . 'mail.ctp';
  		}
  		if ($ActionID == 9) {
  			$InvoiceQ = current($this -> Invoices -> index($InvoiceID));
  			$InvoiceDetailQ = $this -> Invoices -> GetInvoiceDetail($InvoiceID);
  			$Subject = __('TheInvoiceNumber', true) . ': ' . $InvoiceQ['InvoiceNumber'] . ' ' . __('ConfirmVoid', true);
  			$TheTemplate = "invoicepaid_html";
  			//require VIEWS . 'company' . DS . 'mail.ctp';
        require current(App::path("Template")).'/Company' . DS . 'mail.ctp';
  		}

      $this->set('__serialize',["is_success"=>1,"flash"=>$Flash,"invoice_id"=>$InvoiceID]);
    }

}
