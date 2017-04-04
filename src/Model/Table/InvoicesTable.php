<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoices Model
 *
 * @method \App\Model\Entity\Invoice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Invoice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Invoice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Invoice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoicesTable extends Table
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

        $this->setTable('invoices');
        $this->setDisplayField('InvoiceID');
        $this->setPrimaryKey('InvoiceID');
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
            ->integer('InvoiceID')
            ->allowEmpty('InvoiceID', 'create');

        $validator
            ->integer('CompanyID')
            ->requirePresence('CompanyID', 'create')
            ->notEmpty('CompanyID');

        $validator
            ->integer('StatusID')
            ->requirePresence('StatusID', 'create')
            ->notEmpty('StatusID');

        $validator
            ->integer('ClientID')
            ->requirePresence('ClientID', 'create')
            ->notEmpty('ClientID');

        $validator
            ->integer('CurrencyID')
            ->requirePresence('CurrencyID', 'create')
            ->notEmpty('CurrencyID');

        $validator
            ->requirePresence('LocaleCode', 'create')
            ->notEmpty('LocaleCode');

        $validator
            ->allowEmpty('InvoiceNumber');

        $validator
            ->dateTime('InvoiceDate')
            ->allowEmpty('InvoiceDate');

        $validator
            ->numeric('Shipping')
            ->allowEmpty('Shipping');

        $validator
            ->numeric('Tax')
            ->allowEmpty('Tax');

        $validator
            ->allowEmpty('Note');

        $validator
            ->allowEmpty('EmailSubject');

        $validator
            ->allowEmpty('AuthNumber');

        $validator
            ->dateTime('VoidDate')
            ->allowEmpty('VoidDate');

        $validator
            ->dateTime('PaidDate')
            ->allowEmpty('PaidDate');

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
            ->integer('TransactionID')
            ->allowEmpty('TransactionID');

        return $validator;
    }
}
