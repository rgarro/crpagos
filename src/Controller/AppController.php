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
    			$session -> destroy();
    			unset($_GET['logout']);
    			$this -> redirect("/");
    		}
    		//Time Zone Fix
    		putenv("TZ=America/Costa_Rica");
    		//Language Change
    		if (!$session -> check('Languages')) {
    			session_name('CRPagos');
    			$this -> loadModel('Locales');
    			$LangQ = $this -> Locales -> index();

    			$session -> write('Languages', $LangQ);
    			$session -> write('ValidLangCodes', array());
    			foreach ($LangQ as $ThisLan) {
    				$_SESSION['ValidLangCodes'][] = $ThisLan['LocaleCode'];
    			}
    			$session -> write('LocaleCode', 'spa_cr');
    			$this -> Cookie -> write('lang', 'spa_cr', null, '+350 day');
    			$session -> write('MenuLinks_eng_us', array("about-us", "personal", "bussiness", "contact-us", "terms-and-coditions"));
    			$session -> write('MenuLinks_spa_cr', array("acerca-de", "personas", "negocios", "contactenos", "terminos-y-condiciones"));
    		}
    		if (isset($_GET['Lang'])) {
    			$lang = Sanitize::paranoid($_GET['Lang'], array("_"));
    			if ($lang != $session -> read('LocaleCode')) {
    				if (in_array($lang, $session -> read('ValidLangCodes'))) {
    					$session -> write('LocaleCode', $lang);
    				} else {
    					$lang = $session -> read('DefaultLang');
    				}
    				$this -> Cookie -> write('lang', $lang, null, '+350 day');
    				$session -> write('LocaleCode', $lang);
    			}
    		}
    		//L10n
    		$this -> L10n = new L10n();
    		$this -> L10n -> get($session -> read('LocaleCode'));
    		if($session->read('LocaleCode') == 'spa_cr'){
    			setlocale(LC_ALL, 'es_CR');
    		}else{
    			setlocale(LC_ALL, 'en_US');
    		}
    		Configure::write('Config.language', $session -> read('LocaleCode'));
    		//Check if Session has timed out
    		if ($this -> viewPath != 'pages' && $this -> viewPath != 'code') {
    			$Allowed = array("/", "/login/", "/myaccount/recpass/", "/contactus/", "/contactenos/", "/invoice-code/", "/codigo-de-solicitud/");
    			if (!$session -> check('Company.CurrentCompanyID') && !in_array($this -> here, $Allowed)) {
    				$this -> redirect("/" . __('CodeLink', true) . "/?timedout=true");
    			}
    		}
    		//Avoid peering eyes, but allow Pages
    		$AllowPaths = array('pages', 'pay_invoice');
    		if ($session -> check('Company.PayURL') === true && $this -> here !== $session -> read('Company.PayURL') && !in_array($this -> viewPath, $AllowPaths)) {
    			//Redirect to company's Pay URL
    			$this -> redirect($session -> read('Company.PayURL'));
    			exit ;
    		}

    		//Avoid unauthorizeed access to user's
    		if ($session -> read('User.AccessLevel') > 1 && $this -> viewPath == 'users') {
    			//Redirect to company's Pay URL
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
