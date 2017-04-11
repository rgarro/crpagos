<?php
namespace App\Controller;

use Cake\Core\Configure;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\I18n\I18n;
/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
{
  public function initialize(){
      parent::initialize();
      //$this->loadModel('L10n');
      $this->loadModel('Clients');
  }

  public function index(){
		$this->set('ClientsQ', $this->Clients->index());
	}

	public function NewClient() {
		$this->set('GetClientQ', $this->Clients->index(0));
	}

	public function EditClient($ClientID = 0) {
		$ClientID = base64_decode($ClientID);
		$this->set('GetClientQ', $this->Clients->index($ClientID));
	}

  public function SaveClient(){
    if(isset($_POST['ClientID'])){
//Update
      $ClientID = base64_decode($_POST['ClientID']);
      $this->Clients->UpdateClient($ClientID);
    }else{
//Insert
       $ClientID = $this->Clients->AddClient();
    }
    if(!$this->Clients->index($ClientID)){
      $this->Clients->AddClientToCompany($ClientID);
    }
    if(isset($_POST['RazonSocial'])){
      $this->Flash->success(__('CompanySaved', true));
    }else{
      $this->Flash->success(__('ClientSaved', true));
    }
    if(isset($_POST['DeleteClient'])){
      $this->Flash->success(__('ClientDeleted', true));
    }
    if(isset($_POST['DeleteCompany'])){
      $this->Flash->success(__('CompanyDeleted', true));			
    }

    if(isset($_POST['DeleteClient']) || isset($_POST['DeleteCompany'])){
      $this->Redirect('/clients/');
    }else{
      $this->Redirect('/clients/editclient/'.base64_encode($ClientID).'/');
    }
  }

}
