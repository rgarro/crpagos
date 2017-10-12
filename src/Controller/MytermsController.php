<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;
use App\Lib\L10n;
use Cake\Controller\Component\CookieComponent;

class MytermsController extends AppController{

  public function terms(){
    $this->viewBuilder()->setLayout('ajax');
  }
  
}
