<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('Users');
        $this->setDisplayField('UserID');
        $this->setPrimaryKey('UserID');
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('UserID')
            ->allowEmpty('UserID', 'create');

        $validator
            ->allowEmpty('FirstName');

        $validator
            ->allowEmpty('LastName');

        $validator
            ->allowEmpty('Email');

        $validator
            ->allowEmpty('Password');

        $validator
            ->integer('UserStatus')
            ->allowEmpty('UserStatus');

        $validator
            ->integer('AccessLevelID')
            ->requirePresence('AccessLevelID', 'create')
            ->notEmpty('AccessLevelID');

        $validator
            ->allowEmpty('ModifiedBy');

        $validator
            ->dateTime('Entered')
            ->allowEmpty('Entered');

        $validator
            ->allowEmpty('EnteredBy');

        $validator
            ->dateTime('Modified')
            ->allowEmpty('Modified');

        return $validator;
    }

    public function index(){
			$TheLogin = $_POST['Login'];
			$ThePass = $_POST['Password'];
			$TheSql ="SELECT * ";
			$TheSql.=" FROM Users ";
			$TheSql.=" WHERE UserStatus = 1 AND Email <> ''";
			$TheSql.=" AND Email ='".trim($TheLogin)."'";
			$TheSql.=" AND Password = '".trim($ThePass)."'";
			$TheSql.=" ORDER BY AccessLevelID, FirstName, LastName= '".trim($ThePass)."'";
			return $this->connection()->execute($TheSql)->fetch('assoc');
		}

		public function CheckCompany($UserID = null){
			$TheSql ="SELECT * ";
			$TheSql.=" FROM Companies ";
			$TheSql.=" INNER JOIN CompanyUsers ON Companies.CompanyID = CompanyUsers.CompanyID";
			$TheSql.=" WHERE CompanyUsers.UserID = ".$UserID;
			$TheSql.=" AND Companies.CompanyStatus = 1";
			$TheSql.=" ORDER BY Companies.CompanyID";
			return $this->connection()->execute($TheSql)->fetchAll('assoc');
		}

		public function GetUsers($UserID = null){
			$TheSql = " SELECT * ";
			$TheSql.= " FROM Users ";
			$TheSql.= " INNER JOIN CompanyUsers ON Users.UserID = CompanyUsers.UserID ";
			$TheSql.= " INNER JOIN AccessLevels ON Users.AccessLevelID = AccessLevels.AccessLevelID ";
			$TheSql.= " WHERE CompanyUsers.CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
			$TheSql.= " AND  Users.AccessLevelID >= ". $_SESSION['User']['AccessLevelID'];
			if($UserID !== null){
				$TheSql.= " AND Users.UserID = ".$UserID;
			}
			$TheSql.= " ORDER BY Users.AccessLevelID, Users.FirstName, Users.LastName  ";
			return $this->connection()->execute($TheSql)->fetchAll('assoc');
		}

		public function FindUserByEmail($SafeMail = null){
			$TheSql ="SELECT FirstName, LastName, Password, Email ";
			$TheSql.=" FROM Users ";
			$TheSql.=" WHERE UserStatus <> 0 ";
			$TheSql.=" AND Email ='".$SafeMail."'";
			return $this->connection()->execute($TheSql)->fetch('assoc');
		}

		public function AddNewUser(){
			$TheSql = " INSERT INTO Users (FirstName, LastName, Email, Password, AccessLevelID, UserStatus,EnteredBy)";
			$TheSql.=" VALUES ('".trim($_POST['FirstName'])."',";
			$TheSql.="'".substr(trim($_POST['LastName']),0,50)."',";
			$TheSql.="'".substr(trim($_POST['Email']),0,100)."',";
			$TheSql.="'".substr(trim($_POST['Password']),0,20)."',";
			$TheSql.= trim($_POST['AccessLevelID']).",";
			$TheSql.= trim($_POST['UserStatus']).",";
			$TheSql.="'".substr(trim($_SESSION['User']['FullName']),0,200)."')";
			//$DataSet = $this->query($TheSql);
			//$UserID = mysql_insert_id();
      $res = $this->connection()->execute($TheSql);
      return $res->lastInsertId();
		}

		public function UpdateUser($UserID = 0){
			$TheSql = " UPDATE Users ";
			$TheSql.=" SET FirstName = '".substr(trim($_POST['FirstName']),0,50)."',";
			$TheSql.=" LastName = '".substr(trim($_POST['LastName']),0,50)."',";
			$TheSql.=" Email = '".substr(trim($_POST['Email']),0,100)."',";
			$TheSql.=" Password = '".substr(trim($_POST['Password']),0,20)."',";
			$TheSql.=" AccessLevelID =".trim($_POST['AccessLevelID']).",";
			$TheSql.=" UserStatus =".trim($_POST['UserStatus']).",";
			$TheSql.=" Modified = NOW(),";
			$TheSql.=" ModifiedBy ='".substr(trim($_SESSION['User']['FullName']),0,200)."'";
			$TheSql.=" WHERE UserID = ".$UserID;
      return $this->connection()->execute($TheSql);
		}

		public function AddUserToCompany($UserID = 0){
			$TheSql = " INSERT INTO CompanyUsers( CompanyID, UserID ) ";
			$TheSql.= " VALUES (".$_SESSION['Company']['CurrentCompanyID'].",";
			$TheSql.= $UserID.")";
      $res = $this->connection()->execute($TheSql);
      return $res->lastInsertId();
		}

		public function SaveMySettings(){
			$TheSql = " UPDATE Users ";
			$TheSql.=" SET FirstName = '".substr(trim($_POST['FirstName']),0,50)."',";
			$TheSql.=" LastName = '".substr(trim($_POST['LastName']),0,50)."',";
			if(trim($_POST['Password']) != '' ){
				$TheSql.=" Password = '".substr(trim($_POST['Password']),0,20)."',";
			}
			$TheSql.=" Email = '".substr(trim($_POST['Email']),0,100)."'";
			$TheSql.=" WHERE UserID = ".$_SESSION['User']['UserID'];
			return $this->connection()->execute($TheSql);
		}

}
