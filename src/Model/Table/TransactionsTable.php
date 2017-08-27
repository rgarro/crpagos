<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transactions Model
 *
 * @method \App\Model\Entity\Transaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Transaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Transaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction findOrCreate($search, callable $callback = null, $options = [])
 */
class TransactionsTable extends Table
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

        $this->setTable('transactions');
        $this->setDisplayField('TransactionID');
        $this->setPrimaryKey('TransactionID');
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
            ->integer('TransactionID')
            ->allowEmpty('TransactionID', 'create');

        $validator
            ->allowEmpty('SessionID');

        $validator
            ->integer('CommerceID')
            ->requirePresence('CommerceID', 'create')
            ->notEmpty('CommerceID');

        $validator
            ->allowEmpty('IP');

        $validator
            ->integer('InvoiceID')
            ->allowEmpty('InvoiceID');

        $validator
            ->dateTime('RequestDate')
            ->requirePresence('RequestDate', 'create')
            ->notEmpty('RequestDate');

        $validator
            ->dateTime('ResponseDate')
            ->allowEmpty('ResponseDate');

        $validator
            ->allowEmpty('FullResponse');

        $validator
            ->allowEmpty('UserAgent');

        return $validator;
    }

    public function index($TransactionID = 0){
			$TheSql=" SELECT * ";
			$TheSql.=" FROM Transactions ";
			$TheSql.=" WHERE TransactionID = ".$TransactionID;
			$TheSql.=" AND ResponseDate is null";
      $DataSet = $this->connection()->execute($TheSql)->fetch('assoc');
      return $DataSet;
		}

		public function AddTransaction(){
			$TheSql =" INSERT INTO Transactions (IP, InvoiceID, SessionID, CommerceID, UserAgent)";
			$TheSql.=" VALUES (";
			$TheSql.="'".substr(trim($_SERVER['REMOTE_ADDR']),0,20)."',";
			$TheSql.="'".$_SESSION['Client']['InvoiceID']."',";
			$TheSql.= "'".session_id()."',";
			$TheSql.= intval($_SESSION['Company']['CommerceID']).",";
			$TheSql.= "'".$_SERVER['HTTP_USER_AGENT']."')";
      $res = $this->connection()->execute($TheSql);
      return $res->lastInsertId();
		}


		public function UpdateTransResponse($TransactionID = 0, $FullResponse =''){
			$TheSql =" UPDATE Transactions ";
			$TheSql.=" SET ResponseDate = NOW(),";
			$TheSql.=" FullResponse = '".$FullResponse."'";
			$TheSql.=" WHERE TransactionID = ".$TransactionID;
      $res = $this->connection()->execute($TheSql);
      return $res;
		}

}
