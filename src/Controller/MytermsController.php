<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\I18n;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Core\App;
use App\Lib\L10n;

class MytermsController extends AppController{

  public function terms(){
    $this->viewBuilder()->setLayout('ajax');
  }

}
