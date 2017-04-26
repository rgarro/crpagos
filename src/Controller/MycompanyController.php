<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\FileHandler;
use App\Controller\Component\ImageToolboxComponent;
use App\Controller\Component\Image_Toolbox;
use App\Lib\L10n;
use Cake\Core\Configure;
use Cake\Core\App;
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
      //$this->loadComponent('ImageToolbox');
  }

  function index() {
    $session = $this->request->session();
		$this -> set('GetMyCompanyQ', $this -> Companies -> GetSites($session -> read('Company.CurrentCompanyID')));
		$this -> Set('LocalesQ', $this -> Locales -> index());
	}

  function saveme() {
    $session = $this->request->session();
		if ($_FILES['Logo']['error'] == 0) {
			$ImgDir = $this->request->webroot . '/img' . $session -> read('Company.CurrentURL');
			$DeleteLogo = $ImgDir . $session -> read('Company.CurrentLogo');
			@unlink($DeleteLogo);
			$FileHandler = new FileHandler();
			$TheImage = $FileHandler -> save($_FILES['Logo']['tmp_name'], $_FILES['Logo']['name'], $ImgDir, true);
			//App::import('Vendor', 'imagetoolbox', array('file' => 'imagetoolbox' . DS . 'Image_Toolbox.class.php'));
			$box1 = new Image_Toolbox($TheImage);
      //$box1 = new ImageToolboxComponent($TheImage);
			$box1 -> newOutputSize(0, 75, 0, false, "#ffffff");
			$box1 -> save($TheImage);
			$session -> write('Company.CurrentLogo', $_FILES['Logo']['name']);
		}
		$this -> Companies -> SaveMyCompanySettings();
		$session -> write('Company.CurrentInfo', html_entity_decode(trim($_POST['CompanyInfo'])));
		$session -> write('Company.CurrentName', html_entity_decode(trim($_POST['CompanyName'])));
		$session -> write('Company.CurrentDefaultNote', html_entity_decode(trim($_POST['DefaultNote'])));
		$session -> write('Company.CurrentEmail', $_POST['Email']);
		if ($session -> read('LocaleCode') != $_POST['LocaleCode']) {
			$session -> write('LocaleCode', $_POST['LocaleCode']);
			//$this -> L10n = new L10n();
			//$this -> L10n -> get($session -> read('LocaleCode'));
			Configure::write('Config.language', $session -> read('LocaleCode'));
		}
		//refresh companies
		$this->loadModel('Users');
		$session -> delete('Companies');
		$CheckCompanyQ = $this -> Users -> CheckCompany($session->read('User.UserID'));
		$session -> write('Companies', $CheckCompanyQ);

		$this -> Flash->success(__('SettingsSaved', true));
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
			$this -> Flash->success(__('SettingsSaved', true));
			$this -> redirect("/mycompany/terms/");
		}
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
		$this -> Set('TermsQ', $TheTerms);
		$this -> Set('LocalesQ', $LocalesQ);
	}
}
