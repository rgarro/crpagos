<?php
namespace App\Controller;

use Cake\Mailer\Email;
use App\Controller\AppController;

/**
 * Myaccount Controller
 *
 * @property \App\Model\Table\MyaccountTable $Myaccount
 */
class MyaccountController extends AppController {

  public function initialize(){
      parent::initialize();
      //$this->loadModel('L10n');
      $this->loadModel('Users');
  }

  public function recpass() {
    $session = $this->request->session();
		if (!$session -> check('User.UserID')) {
			if (isset($_POST['email'])) {
				$SafeMail = $_POST['email'];
				$UserQ = $this -> Users -> FindUserByEmail($SafeMail);
				if (count($UserQ) > 0) {
					$UserQ = current($UserQ);
/*
          $this -> SwiftMailer -> charset = "utf-8";
					$this -> SwiftMailer -> from = "info@crpagos.com";
					$this -> SwiftMailer -> fromName = "Servicio al cliente crpagos.com";
					$this -> SwiftMailer -> to = array($UserQ['Users']['Email'] => $UserQ['Users']['FirstName'] . " " . $UserQ['Users']['LastName']);
					//$this -> SwiftMailer -> bcc = array('kchanto@pragmasoft.co.cr' => 'Amin');
					$this -> SwiftMailer -> replyTo = "info@crpagos.com";
					$this -> SwiftMailer -> sendAs = "html";
					$this -> set('UserQ', $UserQ);
					if (!$this -> SwiftMailer -> send('recpass', 'Recordatorio de clave crpagos.com')) {
						$this -> log('Error sending email "register".', LOG_ERROR);
					}
          */
					$this ->Flash->success(__('PassSent', true));
					$this -> redirect('/login/');
				} else {
					$this -> Flash->success(__('NoPassSent', true));
				}
			}
		}
	}

	public function index() {
    $session = $this->request->session();
		$this -> set('GetUserQ', $this -> Users -> GetUsers($session -> read('User.UserID')));
	}

	public function saveme() {
    $session = $this->request->session();
		$this -> Users -> SaveMySettings();
		$session -> setFlash(__('SettingsSaved', true));
		$session -> write('User.FirstName', $_POST['FirstName']);
		$session -> write('User.FullName', $_POST['FirstName'] . ' ' . $_POST['LastName']);
		$this -> redirect("/myaccount/");
	}
}
