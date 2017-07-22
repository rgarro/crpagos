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
      if(isset($_GET['company_id']) && is_numeric($_GET['company_id'])){
        $this->viewBuilder()->setLayout('ajax');
        $users = $this->Users->allByCompanyID($_GET['company_id']);
        $this->set('users',$users);
      }else{
        throw new Exception("Must GET a numeric company_id.");
      }
    }

    public function editview(){
      if(isset($_GET['user_id']) && is_numeric($_GET['user_id'])){
        $this->viewBuilder()->setLayout('ajax');
        $session = $this->request->session();
        $user = $this->Users->find('all',["conditions"=>["Users.UserID"=>$_GET['user_id']]]);
        $user->hydrate(false);
        $this->set('user',$user->first());
      }else{
        throw new Exception("Must GET a numeric user_id.");
      }
    }

}
