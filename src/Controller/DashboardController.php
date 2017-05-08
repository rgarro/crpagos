<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;

class DashboardController extends AppController
{

  public function initialize(){
      parent::initialize();
      $session = $this->request->session();
      I18n::locale($session->read('LocaleCodeb'));
  }

    public function index()
    {
      if(isset($_GET['is_ajax'])){
        $this->viewBuilder()->setLayout('ajax');
      }else{
        $this->viewBuilder()->setLayout('admin');
      }
    }

    public function changelang(){
      if (isset($_GET['Lang']) && ($_GET['Lang'] == "spa_cr" || $_GET['Lang'] == "eng_us")) {
        $session = $this->request->session();
        $lang = $_GET['Lang'];
        $this -> Cookie -> write('lang', $lang, null, '+350 day');
        $session -> write('LocaleCode', $lang);
        if($_GET['Lang'] == "eng_us"){
          I18n::locale('en_US');
          $session -> write('LocaleCodeb', 'en_US');
        }
        if($_GET['Lang'] == "spa_cr"){
          I18n::locale('es_CR');
          $session -> write('LocaleCodeb', 'es_CR');
        }
        $this -> Flash->success(__('Language').": ".$session->read('LocaleCodeb'));
        $this -> redirect("/dashboard");
      }else{
        throw new Exception("invalid change language attempt.");
      }
    }

    public function company()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

    public function clients()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

    public function users()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

    public function mycompany()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

    public function terms()
    {
      $this->viewBuilder()->setLayout('ajax');
    }

}
