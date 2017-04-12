<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\FileHandler;
use App\Controller\Component\ImageToolboxComponent;
use App\Controller\Component\Image_Toolbox;
/**
 * Mycompany Controller
 *
 * @property \App\Model\Table\MycompanyTable $Mycompany
 */
class MycompanyController extends AppController
{

  var $FileHandler;

  public function initialize(){
      parent::initialize();
      $this->loadModel('Locales');
      $this->loadModel('Companies');
      $this->loadModel('Terms');
      $this->FileHandler = new FileHandler();
      $this->loadComponent('ImageToolbox');
  }

  function index() {
    $session = $this->request->session();
		$this -> set('GetMyCompanyQ', $this -> Companies -> GetSites($session -> read('Company.CurrentCompanyID')));
		$this -> Set('LocalesQ', $this -> Locales -> index());
	}

  function saveme() {
    $session = $this->request->session();
		if ($_FILES['Logo']['error'] == 0) {
			$ImgDir = WWW_ROOT . 'img' . $session -> read('Company.CurrentURL');
			$DeleteLogo = $ImgDir . $session -> read('Company.CurrentLogo');
			@unlink($DeleteLogo);
			$FileHandler = &new FileHandler();
			$TheImage = $FileHandler -> save($_FILES['Logo']['tmp_name'], $_FILES['Logo']['name'], $ImgDir, true);
			//App::import('Vendor', 'imagetoolbox', array('file' => 'imagetoolbox' . DS . 'Image_Toolbox.class.php'));
			$box1 = new Image_Toolbox($TheImage);
      //$box1 = new ImageToolboxComponent($TheImage);
			$box1 -> newOutputSize(0, 75, 0, false, "#ffffff");
			$box1 -> save($TheImage);
			$this -> Session -> write('Company.CurrentLogo', $_FILES['Logo']['name']);
		}
		$this -> Companies -> SaveMyCompanySettings();
		$this -> Session -> write('Company.CurrentInfo', html_entity_decode(nl2br(Sanitize::html(trim($_POST['CompanyInfo']), ENT_NOQUOTES, 'iso-8859-1'))));
		$this -> Session -> write('Company.CurrentName', html_entity_decode(Sanitize::html(trim($_POST['CompanyName']), ENT_NOQUOTES, 'iso-8859-1')));
		$this -> Session -> write('Company.CurrentDefaultNote', html_entity_decode(Sanitize::html(trim($_POST['DefaultNote']), ENT_NOQUOTES, 'iso-8859-1')));
		$this -> Session -> write('Company.CurrentEmail', $_POST['Email']);
		if ($this -> Session -> read('LocaleCode') != $_POST['LocaleCode']) {
			$this -> Session -> write('LocaleCode', $_POST['LocaleCode']);
			$this -> L10n = new L10n();
			$this -> L10n -> get($this -> Session -> read('LocaleCode'));
			Configure::write('Config.language', $this -> Session -> read('LocaleCode'));
		}
		//refresh companies
		$this->loadModel('Users');
		$this -> Session -> delete('Companies');
		$CheckCompanyQ = $this -> Users -> CheckCompany($this->Session->read('User.UserID'));
		$this -> Session -> write('Companies', $CheckCompanyQ);

		$this -> Session -> setFlash(__('SettingsSaved', true));
		$this -> redirect("/mycompany/");
	}

	function terms() {
    $session = $this->request->session();
		if(isset($_POST['Locales']) && is_array($_POST['Locales'])){
			foreach ($_POST['Locales'] as $ThisLocale) {
				$FieldName = $ThisLocale.'_New';
				if(isset($_POST[$FieldName])){
					$Content = $_POST[$FieldName];
					$this -> Terms -> AddNew($ThisLocale, $Content);
				}else{
					$FieldName = $ThisLocale.'_Content';
					$Content = $_POST[$FieldName];
					$this -> Terms -> Update($ThisLocale, $Content);
				}
			}
			$this -> Session -> setFlash(__('SettingsSaved', true));
			$this -> redirect("/mycompany/terms/");
		}
		$TheTerms = array();
		$TermsQ = $this -> Terms -> index(false);
		$LocalesQ = $this -> Locales -> index();
		if (count($TermsQ) > 0) {
			foreach ($TermsQ as $ThisTerm) {
				$TheTerms[$ThisTerm['Terms']['LocaleCode']] = $ThisTerm['Terms']['Content'];
			}
		} else {
			foreach ($LocalesQ as $ThisTerm) {
				$TheTerms[$ThisTerm['Locales']['LocaleCode']] = null;
			}
		}

		$this -> Set('GetMyCompanyQ', $this -> Companies -> GetSites($this -> Session -> read('Company.CurrentCompanyID')));
		$this -> Set('TermsQ', $TheTerms);
		$this -> Set('LocalesQ', $LocalesQ);
	}



}
