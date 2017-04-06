<?php
namespace App\Controller;

use App\Controller\AppController;


class LoginController extends AppController
{

  var  $uses = array('User');

  public function initialize(){
      parent::initialize();
      $this->loadModel('Users');
  }

  public function index(){
    $session = $this->request->session();
    if ($session->check('User.UserID')) {
      $this->redirect($session->read('Company.CurrentURL'));
      exit();
    }
    $this -> pageTitle = __('Welcome', true);
    if (isset($_POST['Login'])) {
      $CheckLoginQ = $this -> Users -> index();
echo count($CheckLoginQ);
print_r($CheckLoginQ);
exit;
      //we're in, set variables
      if (isset($CheckLoginQ['UserID'])) {
        $CheckLogin = current($CheckLoginQ);
        $CheckCompanyQ = $this -> Users -> CheckCompany($CheckLogin['Users']['UserID']);
        if (count($CheckCompanyQ) > 0) {
          //Set Vatriables
          $session -> write('User.UserID', $CheckLogin['Users']['UserID']);
          $session -> write('User.AccessLevelID', $CheckLogin['Users']['AccessLevelID']);
          $session -> write('User.FirstName', $CheckLogin['Users']['FirstName']);
          $session -> write('User.FullName', $CheckLogin['Users']['FirstName'] . ' ' . $CheckLogin['Users']['LastName']);
          $session -> write('User.Email', $CheckLogin['Users']['Email']);
          //Set CurrentCompany Variables
          $CurrentCompany = current($CheckCompanyQ);
          $session -> write('Company.CurrentCompanyID', $CurrentCompany['Companies']['CompanyID']);
          $session -> write('Company.CurrentSubject', $CurrentCompany['Companies']['EmailSubject']);
          $session -> write('Company.CurrentLogo', $CurrentCompany['Companies']['Logo']);
          $session -> write('Company.CurrentURL', $CurrentCompany['Companies']['CompanyUrl']);
          $session -> write('Company.CurrentCompanyURL', $CurrentCompany['Companies']['CompanyUrl']);
          $session -> write('Company.CurrentEmail', $CurrentCompany['Companies']['Email']);
          $session -> write('Company.CurrentBgColor', $CurrentCompany['Companies']['BgColor']);
          $session -> write('Company.CurrentBgImage', $CurrentCompany['Companies']['BgImage']);
          $session -> write('Company.CurrentName', html_entity_decode($CurrentCompany['Companies']['CompanyName'], ENT_NOQUOTES, 'iso-8859-1'));
          $session -> write('Company.CurrentInfo', html_entity_decode(nl2br($CurrentCompany['Companies']['CompanyInfo']), ENT_NOQUOTES, 'iso-8859-1'));
          $session -> write('Company.CurrentDefaultNote', html_entity_decode(nl2br($CurrentCompany['Companies']['DefaultNote']), ENT_NOQUOTES, 'iso-8859-1'));
          $session -> write('Company.CurrentReplyTo', $CurrentCompany['Companies']['ReplyTo']);
          $session -> write('Company.CurrentExtraCC', $CurrentCompany['Companies']['ExtraCC']);
          //Keep companies on a Variable for future use
          $session -> write('Companies', $CheckCompanyQ);
          //Redirect to company's URL
          $this -> redirect($CheckCompanyQ[0]['Companies']['CompanyUrl']);
        } else {
          //No Company, give the login error
          //$session -> setFlash(__('ErrorLogin', true));
          $this->Flash->error(__('ErrorLogin'));
          $this -> redirect('/login/');
        }
        //not in, set flash, and try again
      } else {
        //$session -> setFlash(__('ErrorLogin', true));
        $this->Flash->error(__('ErrorLogin'));
        $this -> redirect('/login/');
      }
    }
  }

}
