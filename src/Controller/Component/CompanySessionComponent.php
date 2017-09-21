<?php
/**
 * Loads current user and related companies into session
 *
 * @author Rolando <rgarro@gmail.com>
 */
namespace App\Controller\Component;

use Cake\Controller\Component;

class CompanySessionComponent extends Component {

  public $controller = null;
  public $session = null;

  public function initialize(array $config)
  {
    parent::initialize($config);
    $this->controller = $this->_registry->getController();
    $this->session = $this->controller->request->session();
  }

  public function loadData($CheckLogin,$CheckCompanyQ){
    //Set Vatriables
    $this->session->write('logged_out',0);
    $this->session->write('User.UserID', $CheckLogin['UserID']);
    $this->session->write('User.AccessLevelID', $CheckLogin['AccessLevelID']);
    $this->session->write('User.FirstName', $CheckLogin['FirstName']);
    $this->session->write('User.FullName', $CheckLogin['FirstName'] . ' ' . $CheckLogin['LastName']);
    $this->session->write('User.Email', $CheckLogin['Email']);
    //Set CurrentCompany Variables
    $CurrentCompany = current($CheckCompanyQ);

    $this->session->write('Company.CurrentCompanyID', $CurrentCompany['CompanyID']);
    $this->session->write('Company.CurrentSubject', $CurrentCompany['EmailSubject']);
    if(strlen($CurrentCompany['photo']) > 2){
        $this->session->write('Company.CurrentLogo', $CurrentCompany['dir']."/".$CurrentCompany['photo']);
    }else{
      $this->session->write('Company.CurrentLogo', "/img/attachment.jpg");
    }
    //$this->session -> write('Company.CurrentURL', $CurrentCompany['CompanyUrl']);
    $this->session->write('Company.CurrentURL', "/dashboard");
    //$this->session -> write('Company.CurrentURL',"/company?currentCo=".$CurrentCompany['CompanyID']);
    //$this->session -> write('Company.CurrentCompanyURL', $CurrentCompany['CompanyUrl']);
    $this->session->write('Company.CurrentCompanyURL', "/dashboard");
    $this->session->write('Company.CurrentEmail', $CurrentCompany['Email']);
    $this->session->write('Company.CurrentBgColor', $CurrentCompany['BgColor']);
    $this->session->write('Company.CurrentBgImage', $CurrentCompany['BgImage']);
    $this->session->write('Company.CurrentName', html_entity_decode($CurrentCompany['CompanyName'], ENT_NOQUOTES, 'iso-8859-1'));
    $this->session->write('Company.CurrentInfo', html_entity_decode($CurrentCompany['CompanyInfo'], ENT_NOQUOTES, 'iso-8859-1'));
    $this->session->write('Company.CurrentDefaultNote', html_entity_decode($CurrentCompany['DefaultNote'], ENT_NOQUOTES, 'iso-8859-1'));
    $this->session->write('Company.CurrentReplyTo', $CurrentCompany['ReplyTo']);
    $this->session->write('Company.CurrentExtraCC', $CurrentCompany['ExtraCC']);
    //Keep companies on a Variable for future use
    $this->session -> write('Companies', $CheckCompanyQ);
  }
}
