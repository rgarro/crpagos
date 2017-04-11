<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Forms Model
 *
 * @method \App\Model\Entity\Form get($primaryKey, $options = [])
 * @method \App\Model\Entity\Form newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Form[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Form|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Form patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Form[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Form findOrCreate($search, callable $callback = null, $options = [])
 */
class FormsTable extends Table
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

        $this->setTable('forms');
        $this->setDisplayField('FormID');
        $this->setPrimaryKey('FormID');
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
            ->integer('FormID')
            ->allowEmpty('FormID', 'create');

        $validator
            ->requirePresence('LocaleCode', 'create')
            ->notEmpty('LocaleCode');

        $validator
            ->integer('FormType')
            ->allowEmpty('FormType');

        $validator
            ->allowEmpty('Name');

        $validator
            ->allowEmpty('LastName');

        $validator
            ->allowEmpty('IdNumber');

        $validator
            ->allowEmpty('JobPosition');

        $validator
            ->allowEmpty('BusinessName');

        $validator
            ->allowEmpty('RazonSocial');

        $validator
            ->allowEmpty('CedulaJuridica');

        $validator
            ->allowEmpty('BusArea');

        $validator
            ->allowEmpty('Tel1');

        $validator
            ->allowEmpty('Tel2');

        $validator
            ->allowEmpty('Email');

        $validator
            ->allowEmpty('Address');

        $validator
            ->allowEmpty('Comments');

        $validator
            ->dateTime('Entered')
            ->allowEmpty('Entered');

        $validator
            ->allowEmpty('IP');

        return $validator;
    }

    public function index(){
			$TheSql = "INSERT INTO Forms (LocaleCode, FormType, Name, LastName, IdNumber, JobPosition, BusinessName, RazonSocial, CedulaJuridica, BusArea, Tel1, Tel2, Email, Address, Comments, IP )";
			$TheSql .=" VALUES (";
			$TheSql.="'".substr(trim($_SESSION['LocaleCode']),0,20)."',";
			$TheSql.= trim($_POST['FormType']).",";
			$TheSql.="'".substr(trim($_POST['Name']),0,200)."',";
			$TheSql.="'".substr(trim($_POST['LastName']),0,200)."',";
			if(isset($_POST['IdNumber'])){
				$TheSql.="'".substr(trim($_POST['IdNumber']),0,200)."',";
			}else{
				$TheSql .= 'NULL,';
			}
			if(isset($_POST['JobPosition'])){
				$TheSql.="'".substr(trim($_POST['JobPosition']),0,200)."',";
			}else{
				$TheSql .= 'NULL,';
			}
			if(isset($_POST['BusinessName'])){
				$TheSql.="'".substr(trim($_POST['BusinessName']),0,200)."',";
			}else{
				$TheSql .= 'NULL,';
			}
			if(isset($_POST['RazonSocial'])){
				$TheSql.="'".substr(trim($_POST['RazonSocial']),0,200)."',";
			}else{
				$TheSql .= 'NULL,';
			}
			if(isset($_POST['CedulaJuridica'])){
				$TheSql.="'".substr(trim($_POST['CedulaJuridica']),0,50)."',";
			}else{
				$TheSql .= 'NULL,';
			}
			if(isset($_POST['BusArea'])){
				$TheSql.="'".substr(trim($_POST['BusArea']),0,50)."',";
			}else{
				$TheSql .= 'NULL,';
			}
			$TheSql.="'".substr(trim($_POST['Tel1']),0,50)."',";
			if(isset($_POST['Tel2'])){
				$TheSql.="'".substr(trim($_POST['Tel2']),0,50)."',";
			}else{
				$TheSql .= 'NULL,';
			}
			$TheSql.="'".substr(trim($_POST['Email']),0,100)."',";
			if(isset($_POST['Address'])){
				$TheSql.="'".trim($_POST['Address'])."',";
			}else{
				$TheSql .= 'NULL,';
			}
			$TheSql.="'".trim($_POST['Comments'])."',";
			$TheSql.="'".substr($_SERVER['REMOTE_ADDR'],0,20)."'";
			$TheSql.=")";

      $res = $this->connection()->execute($TheSql);
      return $res->lastInsertId();
		}

}
