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
    }
    $this -> pageTitle = __('Welcome', true);
    if (isset($_POST['Login'])) {
      $CheckLoginQ = $this -> Users -> index();
      //we're in, set variables
      if (isset($CheckLoginQ['UserID'])) {
        $CheckLogin = $CheckLoginQ;
        $CheckCompanyQ = $this -> Users -> CheckCompany($CheckLogin['UserID']);
        if (count($CheckCompanyQ) > 0) {
          //Set Vatriables
          $session -> write('User.UserID', $CheckLogin['UserID']);
          $session -> write('User.AccessLevelID', $CheckLogin['AccessLevelID']);
          $session -> write('User.FirstName', $CheckLogin['FirstName']);
          $session -> write('User.FullName', $CheckLogin['FirstName'] . ' ' . $CheckLogin['LastName']);
          $session -> write('User.Email', $CheckLogin['Email']);
          //Set CurrentCompany Variables
          $CurrentCompany = current($CheckCompanyQ);

          $session -> write('Company.CurrentCompanyID', $CurrentCompany['CompanyID']);
          $session -> write('Company.CurrentSubject', $CurrentCompany['EmailSubject']);
          $session -> write('Company.CurrentLogo', $CurrentCompany['Logo']);
          $session -> write('Company.CurrentURL', $CurrentCompany['CompanyUrl']);
          $session -> write('Company.CurrentCompanyURL', $CurrentCompany['CompanyUrl']);
          $session -> write('Company.CurrentEmail', $CurrentCompany['Email']);
          $session -> write('Company.CurrentBgColor', $CurrentCompany['BgColor']);
          $session -> write('Company.CurrentBgImage', $CurrentCompany['BgImage']);
          $session -> write('Company.CurrentName', html_entity_decode($CurrentCompany['CompanyName'], ENT_NOQUOTES, 'iso-8859-1'));
          $session -> write('Company.CurrentInfo', html_entity_decode(nl2br($CurrentCompany['CompanyInfo']), ENT_NOQUOTES, 'iso-8859-1'));
          $session -> write('Company.CurrentDefaultNote', html_entity_decode(nl2br($CurrentCompany['DefaultNote']), ENT_NOQUOTES, 'iso-8859-1'));
          $session -> write('Company.CurrentReplyTo', $CurrentCompany['ReplyTo']);
          $session -> write('Company.CurrentExtraCC', $CurrentCompany['ExtraCC']);
          //Keep companies on a Variable for future use
          $session -> write('Companies', $CheckCompanyQ);
          //Redirect to company's URL
          $this -> redirect($CheckCompanyQ[0]['CompanyUrl']);
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
