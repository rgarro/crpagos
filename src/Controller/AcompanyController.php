<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;

class AcompanyController extends AppController
{

  public function initialize(){
      parent::initialize();
      $session = $this->request->session();
      I18n::locale($session->read('LocaleCodeb'));
      $this->loadModel('Clients');
      $this->loadModel("Invoices");
      $this->loadModel('Companies');
      $this->loadComponent('RequestHandler');
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


    public function save(){
        $session = $this->request->session();
        $company = $this->Companies->get($_GET['CompanyID'],['contain' => []]);
        $cia = $this->Companies->patchEntity($company,$_GET);
        if ($this->Companies->save($cia)) {
            $flash = __('The Company has been saved.');
            $success = 1;
            $invalid_form = 0;
            $errors = [];
        }else{
          $success = 0;
          $flash = __('The Company could not be saved. Please, try again.');
          $invalid_form = 1;
          $errors = $cia->errors();
        }
        $this->set('__serialize',["is_success"=>1,"flash"=>$flash,"invalid_form"=>$invalid_form,"error_list"=>$errors]);
    }

}
