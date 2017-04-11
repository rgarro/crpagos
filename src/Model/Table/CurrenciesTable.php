<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Currencies Model
 *
 * @method \App\Model\Entity\Currency get($primaryKey, $options = [])
 * @method \App\Model\Entity\Currency newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Currency[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Currency|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Currency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Currency[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Currency findOrCreate($search, callable $callback = null, $options = [])
 */
class CurrenciesTable extends Table
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

        $this->setTable('currencies');
        $this->setDisplayField('CurrencyID');
        $this->setPrimaryKey('CurrencyID');
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
            ->integer('CurrencyID')
            ->allowEmpty('CurrencyID', 'create');

        $validator
            ->allowEmpty('CurrencySymbol');

        $validator
            ->allowEmpty('CurrencyName');

        $validator
            ->integer('VPOSCurCode')
            ->allowEmpty('VPOSCurCode');

        return $validator;
    }

    public function index(){
      $TheSql="SELECT Currencies.* ";
      $TheSql.=" FROM Currencies ";
      $TheSql.=" INNER JOIN CompanyCurrencies ON Currencies.CurrencyID = CompanyCurrencies.CurrencyID ";
      $TheSql.=" WHERE CompanyCurrencies.CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
      $TheSql.=" ORDER BY CompanyCurrencies.CurrencyOrder ";
      $DataSet = $this->connection()->execute($TheSql)->fetchAll('assoc');//$this->query($TheSql);
      return $DataSet;
    }

}
