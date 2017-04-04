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

        $this->setTable('companies');
        $this->setDisplayField('CompanyID');
        $this->setPrimaryKey('CompanyID');
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
}
