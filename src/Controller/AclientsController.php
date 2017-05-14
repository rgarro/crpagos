<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;

class AclientsController extends AppController
{

  public function initialize(){
      parent::initialize();
      $session = $this->request->session();
      I18n::locale($session->read('LocaleCodeb'));
      $this->loadModel('Clients');
      $this->loadComponent('RequestHandler');
  }


    public function index()
    {
      if(isset($_GET['company_id']) && is_numeric($_GET['company_id'])){
        $this->viewBuilder()->setLayout('ajax');
        $clients = $this->Clients->allByCompanyID($_GET['company_id']);
        $this->set('clients',$clients);
      }else{
        throw new Exception("Must GET a numeric company_id.");
      }
    }


}
