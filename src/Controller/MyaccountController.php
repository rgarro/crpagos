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
      $this->handle_timeout();
  }

  public function recpass() {
    $session = $this->request->session();
		if (!$session -> check('User.UserID')) {
			if (isset($_POST['email'])) {
				$SafeMail = $_POST['email'];
        $user = $this->Users->find('all',['conditions'=>['Users.email'=>$_POST['email']]]);
				//$UserQ = $this -> Users -> FindUserByEmail($SafeMail);
				if($user->count()) {
					$UserQ = $user->first();
          $EmailSubject ="Recordatorio de clave crpagos.com";
          $Email = new Email('default');
          $Email->setCharset("utf-8");
          $Email->viewVars(array('UserQ'=>$UserQ));
          $Email->emailFormat('html');
          $Email->template("recpass_html");
          $Email->from(array('info@crpagos.com' => 'Servicio al cliente crpagos.com'));
          $Email->replyTo(array("info@crpagos.com" => "Servicio al cliente crpagos.com"));
          $Email->cc(array('kchanto@pragmasoft.co.cr' => 'Amin'));
          $Email->subject($EmailSubject);
          $Email->to(array($UserQ['Email'] => $UserQ['FirstName'] . " " . $UserQ['LastName']));
          //$Email->to(array('rgarro@gmail.com' => 'InfoCRPagos'));
          $Email->send();
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
