<?php
namespace App\Controller;

use Cake\Mailer\Email;
use App\Controller\AppController;

class ContactusController extends AppController
{
  public function initialize(){
      parent::initialize();
  }

  public function index(){
    $session = $this->request->session();
    if(count($_POST) > 0){
      //$FormID = $this->Forms->index();
      $SafeMail = $_POST['Email'];//Sanitize::paranoid($_POST['Email'], array('@', '.'));contact_spa_cr.ctp
      switch ($_POST['FormType']){
        case 1:
          $EmailSubject = __('BusinessForm', true);
        break;
        case 2:
          $EmailSubject = __('PersonalForm', true);
        break;
        default:
          $EmailSubject = __('ContactUsForm', true);
        break;
      }

      $EmailSubject .=" # ".date("F j, Y, g:i a");
      $this->set('Title', $EmailSubject);
      /*$this->SwiftMailer->charset = "iso-8859-1";
      $this->SwiftMailer->from = "info@crpagos.com";
      $this->SwiftMailer->fromName = "Servicio Al Cliente";
      $this->SwiftMailer->to = array('info@crpagos.com'=>'Servicio Al Cliente');
      $this->SwiftMailer->bcc = array("bcc@grupochanto.com"=>"Administrator");
      $this->SwiftMailer->replyTo = "info@crpagos.com";
      $this->SwiftMailer->sendAs = "html";
      if (!$this->SwiftMailer->send('contact_'.$session->read('LocaleCode'), $EmailSubject)) {
          $this->log('Error sending email "register".', LOG_ERROR);
      }*/
      //$Email = new CakeEmail();
      $Email = new Email('default');
      //$Email->viewVars(array('SearchQ'=>$this->viewVars['SearchQ']));
      $Email->emailFormat('html');
      $Email->template('contact_'.$session->read('LocaleCode')."_html");
      $Email->from(array('info@crpagos.com' => 'InfoCRPagos'));
      $Email->replyTo(array("info@crpagos.com" => "InfoCRPagos"));
      $Email->cc(array("bcc@grupochanto.com"=>"Administrator"));
      $Email->subject($EmailSubject);
      //$Email->to(array('info@crpagos.com' => 'InfoCRPagos'));
      $Email->to(array('rgarro@gmail.com' => 'InfoCRPagos'));
      $Email->send();
    }else{
      if($session->read('LocaleCode') == 'spa_cr'){
        $this->redirect('contactenos.htm');
      }else{
        $this->redirect('contact-us.htm');
      }
    }
  }

}
