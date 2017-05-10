<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;

class AusersController extends AppController
{

  public function initialize(){
      parent::initialize();
      $session = $this->request->session();
      I18n::locale($session->read('LocaleCodeb'));
      $this->loadModel('Users');
      
  }


    public function index()
    {
      if((isset($_GET['company_id']) && is_numeric($_GET['company_id'])) && (isset($_GET['status_id']) && is_numeric($_GET['status_id']))){
        $this->viewBuilder()->setLayout('ajax');
        $invoices = $this->Invoices->allByCompanyIDAndStatusID($_GET['company_id'],$_GET['status_id']);
        $this->set('invoices',$invoices);
        $this->set('status_id',$_GET['status_id']);
      }else{
        throw new Exception("Must GET a numeric company_id and status_id.");
      }
    }


}
