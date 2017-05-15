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

    public function save(){
        $session = $this->request->session();
        if(isset($_GET['ClientID']) && is_numeric($_GET['ClientID'])){
          $client = $this->Clients->get($_GET['ClientID'],['contain' => []]);
        }else{
          $client = $this->Clients->newEntity();
        }
        $cli = $this->Clients->patchEntity($client,$_GET);
        if ($this->Clients->save($cli)) {
            $flash = __('The Client has been saved.');
            $success = 1;
            $invalid_form = 0;
            $errors = [];
        }else{
          $success = 0;
          $flash = __('The Client could not be saved. Please, try again.');
          $invalid_form = 1;
          $errors = $cli->errors();
        }
        $this->set('__serialize',["is_success"=>1,"flash"=>$flash,"invalid_form"=>$invalid_form,"error_list"=>$errors]);
    }

}
