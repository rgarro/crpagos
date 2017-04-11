<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Terms Model
 *
 * @method \App\Model\Entity\Term get($primaryKey, $options = [])
 * @method \App\Model\Entity\Term newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Term[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Term|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Term patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Term[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Term findOrCreate($search, callable $callback = null, $options = [])
 */
class TermsTable extends Table
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

        $this->setTable('terms');
        $this->setDisplayField('CompanyID');
        $this->setPrimaryKey(['CompanyID', 'LocaleCode']);
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
            ->allowEmpty('LocaleCode', 'create');

        $validator
            ->allowEmpty('Content');

        $validator
            ->allowEmpty('EnteredBy');

        $validator
            ->dateTime('Entered')
            ->requirePresence('Entered', 'create')
            ->notEmpty('Entered');

        $validator
            ->dateTime('Modified')
            ->allowEmpty('Modified');

        $validator
            ->allowEmpty('ModifiedBy');

        return $validator;
    }

    public function index($ShowLocale = true) {
  		$TheSql = "SELECT LocaleCode, Content ";
  		$TheSql .= " FROM Terms ";
  		$TheSql .= " WHERE CompanyID = " . $_SESSION['Company']['CurrentCompanyID'];
  		if($ShowLocale){
  			$TheSql .= " AND LocaleCode = '" . $_SESSION['LocaleCode']. "'";
  		}
      $DataSet = $this->connection()->execute($TheSql)->fetchAll('assoc');
      return $DataSet;
  	}

  	public function AddNew($LocaleCode = null, $Content = null) {
  		$TheSql = "INSERT INTO Terms (CompanyID, LocaleCode, Content, Entered, EnteredBy) ";
  		$TheSql .= " VALUES(" . $_SESSION['Company']['CurrentCompanyID'] . ",";
  		$TheSql .= "'" . $LocaleCode. "',";
  		$TheSql .= "'" . trim($Content) . "',";
  		$TheSql .= "NOW(),";
  		$TheSql .= $_SESSION['User']['UserID'];
  		$TheSql .= " )";

      $res = $this->connection()->execute($TheSql);
      return $res->lastInsertId();
  	}

  	public function Update($LocaleCode = null, $Content = null) {
  		$TheSql = "UPDATE Terms ";
  		$TheSql .= " SET Content = '" . Sanitize::clean(trim($Content), array('escape' => false)) . "',";
  		$TheSql .= " Modified = NOW(), ";
  		$TheSql .= " ModifiedBy = " . Sanitize::paranoid($_SESSION['User']['UserID']);
  		$TheSql .= " WHERE CompanyID = " . Sanitize::paranoid($_SESSION['Company']['CurrentCompanyID']);
  		$TheSql .= " AND LocaleCode = '" . Sanitize::paranoid($LocaleCode, array('_')) . "'";
      $res = $this->connection()->execute($TheSql);
      return $res;
  	}

}
