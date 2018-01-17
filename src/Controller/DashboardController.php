<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;
use App\Lib\L10n;
use Cake\Controller\Component\CookieComponent;

class DashboardController extends AppController
{

  public function initialize(){
      parent::initialize();
      $session = $this->request->session();
      $this->loadComponent('RequestHandler');
      I18n::locale($session->read('LocaleCodeb'));
      $this->loadModel("Invoices");
      $this->loadModel("Companies");
      $this->loadModel("Terms");
      $this->loadModel("Locales");
      $this->loadModel("AccessLevels");
      $this->loadModel("Clients");
      $this->loadModel("Currencies");
      $this->loadModel('Users');
      $this->handle_timeout();
  }

  public function logout(){
    $session = $this->request->session();
    $session->destroy();
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,$params["path"], $params["domain"],$params["secure"], $params["httponly"]);
    }
    //session_destroy();
    header("Location: /");
    //$this -> redirect('/');
    exit;
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

    public function mycompanylogo(){
      $session = $this->request->session();
      $this->viewBuilder()->setLayout('ajax');
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
  					//$session -> write('Company.CurrentLogo', $CurrentCompany['Logo']);
            if(strlen($CurrentCompany['photo']) > 2){
                $session -> write('Company.CurrentLogo', $CurrentCompany['dir']."/".$CurrentCompany['photo']);
            }else{

              $session -> write('Company.CurrentLogo', "/img/attachment.jpg");
            }
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
          //$this -> Flash->success("");
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
        if(isset($_GET['is_invoice'])){
          $_SESSION['is_invoice'] = 1;
          $this -> redirect("/dashboard#/Company/");
        }else{
            $this -> redirect("/dashboard?Lang=".$_GET['Lang']);
        }
      }else{
        throw new Exception("invalid change language attempt.");
      }
    }

    public function company()
    {
      $this->viewBuilder()->setLayout('ajax');

      $this -> Set('LocalesQ', $this -> Locales -> index());
  		$this -> Set('ClientsQ', $this -> Clients -> index());
  		$this -> Set('CurrencyQ', $this -> Currencies -> index());
  		$this -> Set('InvoiceLogQ', array());
    }

    public function clients()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

    public function myprofile(){
      $this->viewBuilder()->setLayout('ajax');
      $session = $this->request->session();
      if(isset($_SESSION['User']['UserID']) && is_numeric($_SESSION['User']['UserID'])){
        $this->viewBuilder()->setLayout('ajax');
        $session = $this->request->session();
        $user = $this->Users->find('all',["conditions"=>["Users.UserID"=>$_SESSION['User']['UserID']],"contain"=>["AccessLevels"]]);
        $user->hydrate(false);
        $this->set('user',$user->first());
        $alevels = $this->AccessLevels->find('all');
        $alevels->hydrate(false);
        $this->set('alevels',$alevels->all());
      }else{
        throw new Exception("Must GET a numeric user_id.");
      }
    }

    public function users()
    {
      $this->viewBuilder()->setLayout('ajax');
      $alevels = $this->AccessLevels->find('all');
      $alevels->hydrate(false);
      $this->set('alevels',$alevels->all());
    }

    public function mycompany()
    {
      $this->viewBuilder()->setLayout('ajax');
      $session = $this->request->session();
      $this->set("company",$this->Companies->findCompanyByCompanyID($session->read('Company.CurrentCompanyID')));
    }

    public function saveterms(){
      $session = $this->request->session();
      $this->viewBuilder()->setLayout('ajax');
      if(isset($_GET['eng_us_Content'])){
        $this -> Terms -> AddNew($_SESSION['Company']['CurrentCompanyID'],$_SESSION['User']['UserID'],"eng_us", $_GET['eng_us_Content']);
      }
      if(isset($_GET['spa_cr_Content'])){
        $this -> Terms -> AddNew($_SESSION['Company']['CurrentCompanyID'],$_SESSION['User']['UserID'],"spa_cr", $_GET['spa_cr_Content']);
      }
  		$this->set('__serialize',["is_success"=>1,"flash"=>__('TermsUpdated').' '.$session->read('Company.CurrentName')]);
    }

    public function terms()
    {
      $session = $this->request->session();
      $this->viewBuilder()->setLayout('ajax');
      $TheTerms = array();
  		$TermsQ = $this -> Terms -> index(false);
  		$LocalesQ = $this -> Locales -> index();
  		if (count($TermsQ) > 0) {
  			foreach ($TermsQ as $ThisTerm) {
  				$TheTerms[$ThisTerm['LocaleCode']] = $ThisTerm['Content'];
  			}
  		} else {
  			foreach ($LocalesQ as $ThisTerm) {
  				$TheTerms[$ThisTerm['LocaleCode']] = null;
  			}
  		}
  		$this -> Set('GetMyCompanyQ', $this -> Companies -> GetSites($session -> read('Company.CurrentCompanyID')));
  		$this -> Set('TermsQ', $TermsQ );
  		$this -> Set('LocalesQ', $LocalesQ);
    }

}
