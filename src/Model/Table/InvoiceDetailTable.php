<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InvoiceDetail Model
 *
 * @method \App\Model\Entity\InvoiceDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\InvoiceDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InvoiceDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoiceDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoiceDetailTable extends Table
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

        $this->setTable('InvoiceDetail');
        $this->setDisplayField('InvoiceDetailID');
        $this->setPrimaryKey('InvoiceDetailID');
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
            ->integer('InvoiceDetailID')
            ->allowEmpty('InvoiceDetailID', 'create');

        $validator
            ->integer('InvoiceID')
            ->requirePresence('InvoiceID', 'create')
            ->notEmpty('InvoiceID');

        $validator
            ->numeric('UnitPrice')
            ->allowEmpty('UnitPrice');

        $validator
            ->integer('Qty')
            ->allowEmpty('Qty');

        $validator
            ->numeric('Amount')
            ->allowEmpty('Amount');

        $validator
            ->allowEmpty('Description');

        $validator
            ->integer('Taxable')
            ->allowEmpty('Taxable');

        return $validator;
    }
}
