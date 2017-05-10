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
  }


    public function index()
    {
      $this->Clients->hydrate(false);
      $clients = $this->Clients->find('all',["conditions"=>["Clients.CompanyID"=>$_GET['company_id']]]);
      $this->set('clients',$clients);
    }


}
