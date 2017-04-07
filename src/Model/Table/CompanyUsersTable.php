<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyUsers Model
 *
 * @method \App\Model\Entity\CompanyUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyUser findOrCreate($search, callable $callback = null, $options = [])
 */
class CompanyUsersTable extends Table
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

        $this->setTable('company_users');
        $this->setDisplayField('CompanyID');
        $this->setPrimaryKey(['CompanyID', 'UserID']);
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
            ->integer('UserID')
            ->allowEmpty('UserID', 'create');

        return $validator;
    }
}
