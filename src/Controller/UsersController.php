<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

  public function initialize(){
      parent::initialize();
      $this->loadModel('AccessLevels');
      $this->loadModel('Users');
  }

  //Display the User List By Default
  		function index(){
  			$this->set('GetUsersQ', $this->Users->GetUsers());
  			$this->set('GetLevelsQ', $this->AccessLevels->index());
  		}

  //Get The info to Edit User
  		function edituser($UserID = null){
  			$UserID =  base64_decode($UserID);
  			$this->set('GetUserQ', $this->Users->GetUsers($UserID));
  			$this->set('GetLevelsQ', $this->AccessLevels->index());
  		}

  //Get The info to Add New User
  		function addnewuser() {
  			$this->set('GetUserQ', $this->Users->GetUsers(0));
  			$this->set('GetLevelsQ', $this->AccessLevels->index());
  		}


  //Save User	either update or insert
  		function saveuser(){
  			if (isset($_POST['UserID'])){
  				$UserID = base64_decode($_POST['UserID']);
  				$this->Users->UpdateUser($UserID);
  			}else{
  				$UserID = $this->Users->AddNewUser();
  				$this->Users->AddUserToCompany($UserID);
  			}
  			$this->Flash->error(__('UserSaved', true));
  			$this->Redirect('/'.$this->viewPath.'/');
  		}

}
