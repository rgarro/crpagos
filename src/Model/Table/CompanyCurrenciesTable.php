<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyCurrencies Model
 *
 * @method \App\Model\Entity\CompanyCurrency get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyCurrency newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyCurrency[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyCurrency|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyCurrency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyCurrency[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyCurrency findOrCreate($search, callable $callback = null, $options = [])
 */
class CompanyCurrenciesTable extends Table
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

        $this->setTable('CompanyCurrencies');
        $this->setDisplayField('CompanyID');
        $this->setPrimaryKey(['CompanyID', 'CurrencyID']);
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
            ->integer('CurrencyID')
            ->allowEmpty('CurrencyID', 'create');

        $validator
            ->integer('CurrencyOrder')
            ->allowEmpty('CurrencyOrder');

        return $validator;
    }
}
