<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Lib\L10n;
use Cake\I18n\I18n;
use Cake\Controller\Component\CookieComponent;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

var $L10n;


  public function handle_timeout(){
    $session = $this->request->session();
    if(!isset($_SESSION['Company']['CurrentCompanyID'])){
      if($this->request->is('ajax')){
        echo json_encode(array("error"=>1,"timed_out"=>1));
        exit;
      } else {
        $this->Flash->success("session expired ...");
        $this -> redirect("/");
      }
    }
  }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        $session = $this->request->session();
        //Check if we are loggin out;
    		if (isset($_GET['logout']) && $_GET['logout'] == 'yes') {

          $session->delete("User");
          $session->delete("Company");

          $session -> delete('User.UserID');
          $session -> delete('User.AccessLevelID');
          $session -> delete('User.FirstName');
          $session -> delete('User.FullName');
          $session -> delete('User.Email');
          $session -> delete('Company.CurrentCompanyID');
          $session -> delete('Company.CurrentSubject');
          $session -> delete('Company.CurrentLogo');
          $session -> delete('Company.CurrentURL');
          $session -> delete('Company.CurrentCompanyURL');
          $session -> delete('Company.CurrentEmail');
          $session -> delete('Company.CurrentBgColor');
          $session -> delete('Company.CurrentBgImage');
          $session -> delete('Company.CurrentName');
          $session -> delete('Company.CurrentInfo');
          $session -> delete('Company.CurrentDefaultNote');
          $session -> delete('Company.CurrentReplyTo');
          $session -> delete('Company.CurrentExtraCC');
          $session -> delete('Companies');
          $_SESSION['Company']['CurrentCompanyID'] = 0;
    			//$session -> destroy();
          //$session -> renew();
          //session_start();
          session_reset();
          session_destroy();
          header("Location: /");
          exit;
    			$this -> redirect("/");
    		}
    		//Time Zone Fix
    		putenv("TZ=America/Costa_Rica");
    		//Language Change
    		if (!isset($_SESSION['Languages'])) {

    			session_name('CRPagos');
    			$this -> loadModel('Locales');
    			$Langs = $this -> Locales -> index();

    			$session -> write('Languages', $Langs);
    			$session -> write('ValidLangCodes', array());
    			foreach ($Langs as $ThisLan) {
    				$_SESSION['ValidLangCodes'][] = $ThisLan['LocaleCode'];
    			}
    			$session -> write('LocaleCode', 'spa_cr');
    			$this -> Cookie -> write('lang', 'spa_cr', null, '+350 day');
    			$session -> write('MenuLinks_eng_us', array("about-us", "personal", "bussiness", "contact-us", "terms-and-coditions"));
    			$session -> write('MenuLinks_spa_cr', array("acerca-de", "personas", "negocios", "contactenos", "terminos-y-condiciones"));
    		}
    		if (isset($_GET['Lang'])) {
    			$lang = $_GET['Lang'];
    			$this -> Cookie -> write('lang', $lang, null, '+350 day');
          $session -> write('LocaleCode', $lang);
          if($_GET['Lang'] == "eng_us"){
            I18n::locale('en_US');
          }
          if($_GET['Lang'] == "spa_cr"){
            I18n::locale('es_CR');
          }
    		}

if (!isset($_SESSION['LocaleCodeb'])){
  I18n::locale('en_US');
  $session -> write('LocaleCodeb', 'en_US');
  if($session->read('LocaleCode') == 'spa_cr'){
    I18n::locale('es_CR');
    $session -> write('LocaleCodeb', 'es_CR');
  }
  Configure::write('Config.language', $session -> read('LocaleCode'));
}


    		//Check if Session has timed out
    		/*if ($this -> viewPath != 'pages' && $this -> viewPath != 'code') {
    			$Allowed = array("/", "/login/", "/myaccount/recpass/", "/contactus/", "/contactenos/", "/invoice-code/", "/codigo-de-solicitud/");
    			if (!$session -> check('Company.CurrentCompanyID') && !in_array($this -> here, $Allowed)) {
    				$this -> redirect("/" . __('CodeLink', true) . "/?timedout=true");
    			}
    		}*/
    		//Avoid peering eyes, but allow Pages
    		$AllowPaths = array('pages', 'pay_invoice');
    		if ($session -> check('Company.PayURL') === true && $this->request->here() !== $session -> read('Company.PayURL') && !in_array(0,$AllowPaths)) {
    			//Redirect to company's Pay URL
    			$this -> redirect($session -> read('Company.PayURL'));
    			exit ;
    		}

    		//Avoid unauthorizeed access to user's
    		if ($session -> read('User.AccessLevel') > 1 && $this->request->here() == 'users') {
    			//Redirect to company's Pay
    			$this -> redirect($session -> read('Company.PayURL'));
    			exit ;
    		}

    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
