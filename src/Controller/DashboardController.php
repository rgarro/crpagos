<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;

class DashboardController extends AppController
{

  public function initialize(){
      parent::initialize();
      $session = $this->request->session();
      $this->loadComponent('RequestHandler');
      I18n::locale($session->read('LocaleCodeb'));
      $this->loadModel("Invoices");
      $this->loadModel("Companies");
  }

    public function index()
    {
      $session = $this->request->session();
      if(isset($_GET['is_ajax'])){
        $this->viewBuilder()->setLayout('ajax');
      }else{
        $this->viewBuilder()->setLayout('admin');
      }
      $this->set("pending_invoices",$this->Invoices->countByCompanyIDAndStatusID($session->read('Company.CurrentCompanyID'),1));
      $this->set("sent_invoices",$this->Invoices->countByCompanyIDAndStatusID($session->read('Company.CurrentCompanyID'),2));
      $this->set("paid_invoices",$this->Invoices->countByCompanyIDAndStatusID($session->read('Company.CurrentCompanyID'),3));
      $this->set("void_invoices",$this->Invoices->countByCompanyIDAndStatusID($session->read('Company.CurrentCompanyID'),5));
    }

    public function changecompany(){
      $session = $this->request->session();
      //$data = array("is_success"=>1,"flash"=>'Cliente Actualizado.');
      //$this->set('data',array("is_success"=>0,'invalid_form'=>1,"error_list"=>$errors));
      if(isset($_GET['company_id'])){
        $ThisCompany = $_GET['company_id'];
      }
  		//Check if we're swtiching companies
  		if ($session -> read('Company.CurrentCompanyID') != $ThisCompany) {
  			$session -> write('Company.CurrentCompanyID', $ThisCompany);
  			foreach ($session->read('Companies') as $CurrentCompany) {
  				if ($CurrentCompany['CompanyID'] == $ThisCompany) {
  					//If Access OK, set the variables
  					$session -> write('Company.CurrentSubject', $CurrentCompany['EmailSubject']);
  					$session -> write('Company.CurrentLogo', $CurrentCompany['Logo']);
  					//$session -> write('Company.CurrentURL', $CurrentCompany['CompanyUrl']);
  					//$session -> write('Company.CurrentCompanyURL', $CurrentCompany['CompanyUrl']);
            $session -> write('Company.CurrentURL', "/company/");
  					$session -> write('Company.CurrentCompanyURL', "/company/");
            $session -> write('Company.CurrentEmail', $CurrentCompany['Email']);
  					$session -> write('Company.CurrentReplyTo', $CurrentCompany['ReplyTo']);
  					$session -> write('Company.CurrentExtraCC', $CurrentCompany['ExtraCC']);
  					$session -> write('Company.CurrentName', html_entity_decode($CurrentCompany['CompanyName'], ENT_NOQUOTES, 'iso-8859-1'));
  					$session -> write('Company.CurrentInfo', html_entity_decode($CurrentCompany['CompanyInfo'], ENT_NOQUOTES, 'iso-8859-1'));
  					$session -> write('Company.CurrentDefaultNote', html_entity_decode($CurrentCompany['DefaultNote'], ENT_NOQUOTES, 'iso-8859-1'));
  					$AccessOK = "yes";
  					//break;
  				}
  			}
  		}
      $this->set('__serialize',["is_success"=>1,"flash"=>__('PleaseSelectCompany').' '.$session->read('Company.CurrentName')]);
    }

    public function changelang(){
      if (isset($_GET['Lang']) && ($_GET['Lang'] == "spa_cr" || $_GET['Lang'] == "eng_us")) {
        $session = $this->request->session();
        $lang = $_GET['Lang'];
        $this -> Cookie -> write('lang', $lang, null, '+350 day');
        $session -> write('LocaleCode', $lang);
        if($_GET['Lang'] == "eng_us"){
          I18n::locale('en_US');
          $session -> write('LocaleCodeb', 'en_US');
        }
        if($_GET['Lang'] == "spa_cr"){
          I18n::locale('es_CR');
          $session -> write('LocaleCodeb', 'es_CR');
        }
        $this -> Flash->success(__('Language').": ".$session->read('LocaleCodeb'));
        $this -> redirect("/dashboard");
      }else{
        throw new Exception("invalid change language attempt.");
      }
    }

    public function company()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

    public function clients()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

    public function users()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

    public function mycompany()
    {
      $this->viewBuilder()->setLayout('ajax');
      $session = $this->request->session();
      $this->set("company",$this->Companies->findCompanyByCompanyID($session->read('Company.CurrentCompanyID')));
    }

    public function terms()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

}
