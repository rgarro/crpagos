<?php
namespace App\Controller;

use App\Controller\AppController;


class DashboardController extends AppController
{

    public function index()
    {
      if(isset($_GET['is_ajax'])){
        $this->viewBuilder()->setLayout('ajax');
      }else{
        $this->viewBuilder()->setLayout('admin');
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
