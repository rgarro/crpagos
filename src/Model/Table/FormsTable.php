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
}
