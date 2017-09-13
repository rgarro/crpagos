<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 */
class CompaniesTable extends Table
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

        $this->setTable('Companies');
        $this->setDisplayField('CompanyID');
        $this->setPrimaryKey('CompanyID');
        $this->hasMany('Clients', ['className' => 'Clients']);
        $this->hasMany('Invoices', ['className' => 'Invoices']);
        $this->addBehavior('Josegonzalez/Upload.Upload',['photo']);
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
            ->integer('CompanyID')
            ->allowEmpty('CompanyID', 'create');

        $validator
            ->requirePresence('LocaleCode', 'create')
            ->notEmpty('LocaleCode');

        $validator
            ->allowEmpty('CompanyName');

        $validator
            ->allowEmpty('Email');

        $validator
            ->allowEmpty('ReplyTo');

        $validator
            ->allowEmpty('ExtraCC');

        $validator
            ->allowEmpty('Logo');

        $validator
            ->allowEmpty('CompanyUrl');

        $validator
            ->integer('CompanyStatus')
            ->allowEmpty('CompanyStatus');

        $validator
            ->allowEmpty('EmailSubject');

        $validator
            ->allowEmpty('TaxID');

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

        $validator
            ->allowEmpty('CompanyInfo');

        $validator
            ->requirePresence('Processor', 'create')
            ->notEmpty('Processor');

        $validator
            ->integer('AcquirerID')
            ->allowEmpty('AcquirerID');

        $validator
            ->integer('CommerceID')
            ->allowEmpty('CommerceID');

        $validator
            ->integer('MallID')
            ->allowEmpty('MallID');

        $validator
            ->allowEmpty('TerminalID');

        $validator
            ->allowEmpty('HexNumber');

        $validator
            ->allowEmpty('KeyName');

        $validator
            ->allowEmpty('BgColor');

        $validator
            ->allowEmpty('BgImage');

        $validator
            ->allowEmpty('DefaultNote');

        return $validator;
    }


    public function findCompanyByCompanyID($company_id){
      $companies = $this->find('all',["conditions"=>["Companies.CompanyID"=>$company_id]]);
      $companies->hydrate(false);
      return $companies->first();
    }

    public function index($CommerceID = 0){
			$TheSql=" SELECT * ";
			$TheSql.=" FROM Companies ";
			$TheSql.=" WHERE CompanyStatus = 1 ";
			$TheSql.=" AND CommerceID = ".$CommerceID;
      //$this->connection()->execute($TheSql);
			//$DataSet = $this->query($TheSql);
			//return $DataSet;
      return $this->connection()->execute($TheSql)->fetchAll('assoc');
		}

		public function GetSites($ThisSite = 0){
			$TheSql="SELECT * ";
			$TheSql.=" FROM Companies ";
			if($ThisSite){
				if(is_numeric($ThisSite)){
					$TheSql.="WHERE CompanyID = ".$ThisSite;
				}else{
					$TheSql.="WHERE CompanyName = '".$ThisSite."'";
				}
			}
			$DataSet = $this->connection()->execute($TheSql)->fetchAll('assoc');
			return $DataSet;
		}

		public function SaveMyCompanySettings(){
			$TheSql = " UPDATE Companies ";
			$TheSql.=" SET LocaleCode = '".substr(trim($_POST['LocaleCode']),0,50)."',";
			$TheSql.=" CompanyName = '".substr(trim($_POST['CompanyName']),0,150)."',";
			$TheSql.=" Email = '".substr(trim($_POST['Email']),0,100)."',";
			if($_FILES['Logo']['error'] == 0){
				$TheSql.=" Logo = '".substr(trim($_FILES['Logo']['name']),0,100)."',";
			}
			$TheSql.=" CompanyName = '".substr(trim($_POST['CompanyName']),0,150)."',";
			//$TheSql.=" EmailSubject = '".substr(Sanitize::escape(trim($_POST['EmailSubject'])),0,100)."',";
			$TheSql.=" TaxID = '".substr(trim($_POST['TaxID']),0,100)."',";
			$TheSql.=" CompanyInfo = '".trim($_POST['CompanyInfo'])."',";
			$TheSql.=" DefaultNote = '".trim($_POST['DefaultNote'])."',";
			$TheSql.=" Modified = NOW(),";
			$TheSql.=" ModifiedBy ='".substr(trim($_SESSION['User']['FullName']),0,200)."'";
			$TheSql.=" WHERE CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
			$DataSet = $this->connection()->execute($TheSql);
			return $DataSet;
		}
}
