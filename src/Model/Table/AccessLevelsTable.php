<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccessLevels Model
 *
 * @method \App\Model\Entity\AccessLevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\AccessLevel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AccessLevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AccessLevel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccessLevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AccessLevel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AccessLevel findOrCreate($search, callable $callback = null, $options = [])
 */
class AccessLevelsTable extends Table
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

        $this->setTable('AccessLevels');
        $this->setDisplayField('AccessLevelID');
        $this->setPrimaryKey('AccessLevelID');
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
            ->integer('AccessLevelID')
            ->allowEmpty('AccessLevelID', 'create');

        $validator
            ->allowEmpty('AccessLevel');

        return $validator;
    }
}
