<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Status Model
 *
 * @method \App\Model\Entity\Status get($primaryKey, $options = [])
 * @method \App\Model\Entity\Status newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Status[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Status|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Status patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Status[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Status findOrCreate($search, callable $callback = null, $options = [])
 */
class StatusTable extends Table
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

        $this->setTable('Status');
        $this->setDisplayField('StatusID');
        $this->setPrimaryKey('StatusID');
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
            ->integer('StatusID')
            ->allowEmpty('StatusID', 'create');

        $validator
            ->allowEmpty('Status');

        return $validator;
    }

    public function index($StatusID = null) {
  		$TheSql = "SELECT * ";
  		$TheSql .= " FROM Status ";
  		$TheSql .= " WHERE StatusID <> 3 ";
  		if ($StatusID) {
  			$TheSql .= " AND StatusID >= " . $StatusID;
  		} else {
  			$TheSql .= " AND StatusID <> 2";
  		}
  		$TheSql .= " ORDER BY StatusID ";
      $DataSet = $this->connection()->execute($TheSql)->fetchAll('assoc');
      return $DataSet;
  	}

}
