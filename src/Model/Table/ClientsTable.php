<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clients Model
 *
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, callable $callback = null, $options = [])
 */
class ClientsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('clients');
        $this->setDisplayField('ClientID');
        $this->setPrimaryKey('ClientID');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('ClientID')
            ->allowEmpty('ClientID', 'create');

        $validator
            ->integer('CompanyID')
            ->requirePresence('CompanyID', 'create')
            ->notEmpty('CompanyID');

        $validator
            ->allowEmpty('Email');

        $validator
            ->allowEmpty('Phone');

        $validator
            ->allowEmpty('ClientName');

        $validator
            ->allowEmpty('ClientLastName');

        $validator
            ->allowEmpty('CedulaJuridica');

        $validator
            ->allowEmpty('RazonSocial');

        $validator
            ->integer('ClientStatus')
            ->allowEmpty('ClientStatus');

        $validator
            ->dateTime('Entered')
            ->allowEmpty('Entered');

        $validator
            ->allowEmpty('EnteredBy');

        $validator
            ->dateTime('Modified')
            ->allowEmpty('Modified');

        $validator
            ->allowEmpty('ModifiedBy');

        return $validator;
    }

    public function index($ClientID = null){
      $TheSql = " SELECT * ";
      $TheSql.= " FROM Clients ";
      $TheSql.= " WHERE CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
      $TheSql.= " AND ClientStatus = 1 ";
      if($ClientID !== null){
        $TheSql.= " AND ClientID = ".$ClientID;
      }else{
        $TheSql.= " ORDER BY ClientName ";
      }
      //$DataSet = $this->query($TheSql);
      //return $DataSet;
      return $this->connection()->execute($TheSql)->fetchAll('assoc');
    }

    public function AddClient(){
      //Sanitize::clean($_POST);
      //$this->query("LOCK TABLES Clients WRITE");
      $TheSql = " INSERT INTO Clients (CompanyID, Email, Phone, CedulaJuridica, RazonSocial, ClientName, ClientLastName, EnteredBy)";
      $TheSql.=" VALUES (".$_SESSION['Company']['CurrentCompanyID'].",";
      $TheSql.="'".substr(trim($_POST['Email']),0,100)."',";
      if(isset($_POST['Phone'])){
        $TheSql.="'".substr(trim($_POST['Phone']),0,20)."',";
      }else{
        $TheSql.="null,";
      }
      if(isset($_POST['CedulaJuridica'])){
        $TheSql.="'".substr(trim($_POST['CedulaJuridica']), array('-'),0,50)."',";
      }else{
        $TheSql.="null,";
      }
      if(isset($_POST['RazonSocial'])){
        $TheSql.="'".substr(trim($_POST['RazonSocial']),0,200)."',";
      }else{
        $TheSql.="null,";
      }
      $TheSql.="'".substr(trim($_POST['ClientName']),0,30)."',";
      $TheSql.="'".substr(trim($_POST['ClientLastName']),0,50)."',";
      $TheSql.="'".substr(trim($_SESSION['User']['FullName']),0,200)."')";
      $DataSet = $this->query($TheSql);
      $ClientID = mysql_insert_id();
      //$this->query("UNLOCK TABLES");
      return $ClientID;
    }

    function UpdateClient($ClientID = null){
      Sanitize::clean($_POST);
      $this->query("LOCK TABLES Clients WRITE");
      $TheSql =" UPDATE Clients ";
      $TheSql.=" SET Email ='".substr(Sanitize::clean(trim($_POST['Email'])),0,100)."',";
      if(isset($_POST['Phone'])){
        $TheSql.=" Phone ='".substr(Sanitize::paranoid(trim($_POST['Phone']), array('-')),0,20)."',";
      }
      if(isset($_POST['DeleteClient']) || isset($_POST['DeleteCompany'])){
        $TheSql.=" ClientStatus = 0,";
      }
      if(isset($_POST['CedulaJuridica'])){
        $TheSql.="CedulaJuridica = '".substr(Sanitize::paranoid(trim($_POST['CedulaJuridica']), array('-')),0,50)."',";
      }
      if(isset($_POST['RazonSocial'])){
        $TheSql.="RazonSocial = '".substr(Sanitize::escape(trim($_POST['RazonSocial'])),0,200)."',";
      }
      $TheSql.=" ClientName = '".substr(Sanitize::escape(trim($_POST['ClientName'])),0,30)."',";
      $TheSql.=" ClientLastName ='".substr(Sanitize::escape(trim($_POST['ClientLastName'])),0,50)."',";
      $TheSql.=" Modified = NOW(),";
      $TheSql.=" ModifiedBy ='".substr(Sanitize::escape(trim($_SESSION['User']['FullName'])),0,200)."'";
      $TheSql.=" WHERE CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
      $TheSql.=" AND ClientID =".$ClientID;
      $DataSet = $this->query($TheSql);
      $this->query("UNLOCK TABLES");
      return $DataSet;
    }

}
