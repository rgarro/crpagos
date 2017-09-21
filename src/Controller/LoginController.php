<?php
namespace App\Controller;

use App\Controller\AppController;


class LoginController extends AppController
{

  var  $uses = array('User');

  public function initialize(){
      parent::initialize();
      $this->loadModel('Users');
      $this->loadComponent('CompanySession');
  }

  public function index(){
    $session = $this->request->session();
    $this -> pageTitle = __('Welcome', true);
    if (isset($_POST['Login'])) {
      $CheckLoginQ = $this->Users->index($_POST['Login'],$_POST['Password']);
      if (isset($CheckLoginQ['UserID'])) {
        $CheckLogin = $CheckLoginQ;
        $CheckCompanyQ = $this->Users->CheckCompany($CheckLogin['UserID']);
        if (count($CheckCompanyQ) > 0) {
          $this->CompanySession->loadData($CheckLogin,$CheckCompanyQ);
          $this -> redirect("/dashboard");
        } else {
          $this->Flash->error(__('ErrorLogin'));
          $this -> redirect('/');
        }
      } else {
        $this->Flash->error(__('ErrorLogin'));
        $this -> redirect('/');
      }
    }
  }

}
