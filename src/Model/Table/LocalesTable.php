<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locales Model
 *
 * @method \App\Model\Entity\Locale get($primaryKey, $options = [])
 * @method \App\Model\Entity\Locale newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Locale[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Locale|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Locale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Locale[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Locale findOrCreate($search, callable $callback = null, $options = [])
 */
class LocalesTable extends Table
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

        $this->setTable('locales');
        $this->setDisplayField('LocaleCode');
        $this->setPrimaryKey('LocaleCode');
    }

public function index(){
  $TheSql="SELECT * ";
  $TheSql.=" FROM Locales ";
  //$DataSet = $this->query($TheSql);
  return $this->connection()->execute($TheSql)->fetchAll('assoc');//$DataSet;
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
            ->allowEmpty('LocaleCode', 'create');

        $validator
            ->allowEmpty('Locale');

        $validator
            ->allowEmpty('LocaleFallback');

        $validator
            ->allowEmpty('Charset');

        $validator
            ->allowEmpty('VPOSLangCode');

        return $validator;
    }
}
