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
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

  public function initialize(){
      parent::initialize();
      $this->loadComponent('Crypter');
  }

  public function login(){
    $session = $this->request->session();
    $this->viewBuilder()->setLayout('login');
    if(isset($_SESSION['Company']['CurrentCompanyID'])){
        //$this->Flash->success("in session ...");
        $this -> redirect("/dashboard");
    }
  }

  public function  index(){
    $session = $this->request->session();
    $this->pageTitle=__('Welcome', true);
//Check if there's a Code
    if(isset($_GET['CodigoFactura']) &&  strlen(trim($_GET['CodigoFactura'])) > 0){
      $TheInvoice = rawurldecode($_GET['CodigoFactura']);
    }elseif(
      isset($_GET['InvoiceCode']) && strlen(($_GET['InvoiceCode'])) > 0){
      $TheInvoice = rawurldecode($_GET['InvoiceCode']);
    }else{
      $TheInvoice = "";
    }
//Unecrypt It
    if(strlen(trim($TheInvoice)) > 0){
      $session->delete('Company');
      $session->delete('User');
      $session->delete('Client');
      $InvoiceID = $this->Crypter->deCrypt($TheInvoice);
      if(!is_numeric($InvoiceID)){
//Invalid Encryption
        $InvoiceID = 0;
      }
//Get it fom DB
      $InvoiceQ = $this->Invoices->GetInvoice($InvoiceID,true);
//Valid Number
      if(count($InvoiceQ) == 1){
        $CurrentCompany = current($InvoiceQ);
//Get The company info from Invoice
        $lang = $CurrentCompany['Invoices']['LocaleCode'];
        //$this->L10n->get($lang);
        Configure::write('Config.language', $lang);
        $session->write('LocaleCode', $lang);
        $this->Cookie->write('lang', $lang, null, '+350 day');
        $session->write('Client.InvoiceID', $InvoiceID);
        $session->write('User.FullName', $_SERVER['REMOTE_ADDR']);
        $session->write('Company.CurrentCompanyID', $CurrentCompany['Companies']['CompanyID'] );
        $session->write('Company.CurrentName', $CurrentCompany['Companies']['CompanyName'] );
        $session->write('Company.CurrentSubject', $CurrentCompany['Companies']['EmailSubject'] );
        $session->write('Company.CurrentLogo', $CurrentCompany['Companies']['Logo'] );
        $session->write('Company.CurrentURL', $CurrentCompany['Companies']['CompanyUrl'] );
        $session->write('Company.CurrentEmail', $CurrentCompany['Companies']['Email'] );
        $session->write('Company.CurrentBgColor', $CurrentCompany['Companies']['BgColor'] );
        $session->write('Company.CurrentBgImage', $CurrentCompany['Companies']['BgImage'] );
        $session->write('Company.CurrentName', html_entity_decode($CurrentCompany['Companies']['CompanyName'],ENT_NOQUOTES,'iso-8859-1'));
        $session->write('Company.CurrentInfo', html_entity_decode($CurrentCompany['Companies']['CompanyInfo'],ENT_NOQUOTES,'iso-8859-1'));
        $session->write('Company.PayURL',$CurrentCompany['Companies']['CompanyUrl'].strtolower(__('PayUrl', true)).'/');
        $Comment = __('InvoiceDisplayed', true).' '.$_SERVER['REMOTE_ADDR'];
//BNCR Stuff
        $session->write('Company.AcquirerID', $CurrentCompany['Companies']['AcquirerID']);
        $session->write('Company.CommerceID', $CurrentCompany['Companies']['CommerceID']);
        $session->write('Company.MallID', $CurrentCompany['Companies']['MallID']);
        $session->write('Company.TerminalID', $CurrentCompany['Companies']['TerminalID']);
        $session->write('Company.HexNumber', $CurrentCompany['Companies']['HexNumber']);
        $session->write('Company.KeyName', $CurrentCompany['Companies']['KeyName']);

        $session->write('Company.Processor', $CurrentCompany['Companies']['Processor']);
        $this->Invoices->AddInvoiceLog($InvoiceID, 7, $Comment);
//Redirect to company's PayURL
        $this->redirect($session->read('Company.PayURL'));
      }else{
//Invalid Number,  send to "Home"
        $session->setFlash(__('NoneFound', true));
        $this->redirect('notfound.htm');
      }
    }else{
//No Code, send to "Home"
      $this->setAction ('display', 'home');
    }
  }

  public function terms(){
    $this->loadModel('Terms');
    $this->Set('TermsQ', $this -> Terms -> index());
    Configure::write('debug', 0);
    $this->layout = "terms";
  }

    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
     public function display($page = home){

 			$this->render("/Pages/".$page);
 		}
    /*public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }*/
}
