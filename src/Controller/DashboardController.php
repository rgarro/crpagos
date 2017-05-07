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

}
