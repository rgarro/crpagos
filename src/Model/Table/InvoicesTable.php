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

        $this->setTable('Invoices');
        $this->setDisplayField('InvoiceID');
        $this->setPrimaryKey('InvoiceID');
        $this->belongsTo('Companies', ['className' => 'Companies','foreignKey'=>"CompanyID"]);
        $this->belongsTo('Clients', ['className' => 'Clients','foreignKey'=>"ClientID","propertyName"=>"Client"]);
        $this->belongsTo('Currencies', ['className' => 'Currencies','foreignKey'=>"CurrencyID","propertyName"=>"Currency"]);
        $this->hasOne('InvoiceDetail', ['className' => 'InvoiceDetail','foreignKey'=>"InvoiceID","propertyName"=>"Detail"]);
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

    public function allByCompanyIDAndStatusID($company_id,$status_id){
      $invoices = $this->find('all',["conditions"=>["Invoices.CompanyID"=>$company_id,"Invoices.StatusID"=>$status_id],"contain"=>["Clients","InvoiceDetail","Currencies"]]);
      $invoices->hydrate(false);
      return $invoices->all();
    }

    public function index($InvoiceID = null, $StatusID = null, $TheQuery = null, $TheSort = 'ASC'){
			$TheSql =" SELECT  Invoices.*, Clients.*, Status.*, Currencies.*, sum(Amount) as TheTotal, max(Description) as ShortDesc, Locales.VPOSLangCode";
			$TheSql.=" FROM Invoices ";
			$TheSql.=" INNER JOIN InvoiceDetail ON Invoices.InvoiceID = InvoiceDetail.InvoiceID ";
			$TheSql.=" INNER JOIN Status ON Invoices.StatusID = Status.StatusID ";
			$TheSql.=" INNER JOIN Clients ON Invoices.ClientID = Clients.ClientID ";
			$TheSql.=" INNER JOIN Currencies ON Invoices.CurrencyID = Currencies.CurrencyID ";
			$TheSql.=" INNER JOIN Locales ON Invoices.LocaleCode = Locales.LocaleCode ";
			$TheSql.=" WHERE Invoices.CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
			$TheSql.=" AND Clients.CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
			$TheSql.=" AND Invoices.StatusID <> 6 ";
			if(is_numeric($InvoiceID)){
				$TheSql.=" AND Invoices.InvoiceID = ".$InvoiceID;
			}
			if($StatusID){
				$TheSql.=" AND Invoices.StatusID > ".$StatusID;
			}
			if(!is_null($TheQuery)){
				$TheSql.= $TheQuery;
			}
			$TheSql.=" GROUP BY Invoices.InvoiceID, Invoices.ClientID, Status.StatusID, Invoices.CurrencyID, Invoices.LocaleCode";
			$TheSql.=" ORDER BY Invoices.StatusID, InvoiceDate ".$TheSort;
      $DataSet = $this->connection()->execute($TheSql)->fetchAll('assoc');//$this->query($TheSql);
      return $DataSet;
		}

		public function AddInvoice(){
			$TheSql =" INSERT INTO Invoices(CompanyID, StatusID, ClientID, InvoiceNumber, LocaleCode, InvoiceDate, CurrencyID, Note, EmailSubject,EnteredBy) ";
			$TheSql.=" VALUES (".$_SESSION['CurrentCompanyID'].",";
			$TheSql.="1,";
			$TheSql.=$_POST['ClientID'].",";
			$TheSql.="'".$_POST['InvoiceNumber']."',";
			$TheLocale = $_POST['LocaleCode'];
			$TheSql.="'".$TheLocale."',";
			if($TheLocale == 'eng_us'){
				$DateFormat =  "%m/%d/%Y";
			}else{
				$DateFormat =  "%m/%d/%Y";
			}
			$TheSql.="STR_TO_DATE('".$_POST['InvoiceDate']."', '$DateFormat'),";
			$TheSql.=$_POST['CurrencyID'].",";
			$TheSql.="'".$_POST['Note']."',";
			$TheSql.="'".$_POST['EmailSubject']."',";
			$TheSql.="'".$_SESSION['User']['FullName']."')";
      $res = $this->connection()->execute($TheSql);
      return $res->lastInsertId();
		}

		public function AddInvoiceDetail($InvoiceID = null, $Qty = 0, $Description = null, $UnitPrice = 0, $Amount = 0){
			$TheSql =" INSERT INTO InvoiceDetail(InvoiceID, UnitPrice, Qty, Amount, Description ) ";
			$TheSql.=" VALUES (".$InvoiceID.",";
			$TheSql.=$UnitPrice.",";
			$TheSql.=$Qty.",";
			$TheSql.=$Amount.",";
			$TheSql.="'".$Description."')";
      $res = $this->connection()->execute($TheSql);
      return $res->lastInsertId();
		}

		public function AddInvoiceLog($InvoiceID = null, $ActionID = 0, $Comments = null){
			$TheSql =" INSERT INTO InvoiceLog(InvoiceID, ActionID, ActionDate, Comment, ActionBy, IP )";
			$TheSql.=" VALUES (".$InvoiceID.",";
			$TheSql.=$ActionID.",";
			$TheSql.="NOW(),";
			$TheSql.="'".$Comments."',";
			$TheSql.="'".$_SESSION['User']['FullName']."',";
			$TheSql.="'".$_SERVER['REMOTE_ADDR']."'";
			$TheSql.=")";
      $res = $this->connection()->execute($TheSql);
      return $res->lastInsertId();
		}

		public function UpdateInvoice($InvoiceID = 0){
			$TheSql =" UPDATE Invoices";
			$TheSql.=" SET ";
			if(isset($_POST['LocaleCode'])){
				$TheLocale = $_POST['LocaleCode'];
				$TheSql.=" LocaleCode ='".$TheLocale."',";
			}
			if($_POST['StatusID'] == 4){
				$TheSql.=" AuthNumber ='".$_POST['RefNumber']."',";
				$TheSql.=" PaidDate = NOW(),";
			}
			if($_POST['StatusID'] == 5){
				$TheSql.=" AuthNumber ='".$_SESSION['User']['FullName']."',";
				$TheSql.=" VoidDate = NOW(),";
			}
			if(isset($_POST['InvoiceNumber'])){
				$TheSql.=" InvoiceNumber='".$_POST['InvoiceNumber']."',";
			}
			if(isset($_POST['ClientID'])){
				$TheSql.=" ClientID=".$_POST['ClientID'].",";
			}
			if(isset($_POST['InvoiceDate'])){
				if($TheLocale == 'eng_us'){
					$DateFormat =  "%m/%d/%Y";
				}else{
					$DateFormat =  "%m/%d/%Y";
				}
				$TheSql.=" InvoiceDate =STR_TO_DATE('".$_POST['InvoiceDate']."', '$DateFormat'),";
			}
			if(isset($_POST['EmailSubject'])){
				$TheSql.=" EmailSubject = '".$_POST['EmailSubject']."',";
			}
			if(isset($_POST['Note'])){
				if(isset($_POST['CurrentNote'])){
					$TheNote = "***".base64_decode($_POST['CurrentNote'])."***<br>";
					$TheNote.=$_POST['Note'];
				}else{
					$TheNote = $_POST['Note'];
				}
			$TheSql.=" Note = '". $TheNote."',";
			}
			if(isset($_POST['CurrencyID'])){
				$TheSql.=" CurrencyID = ".$_POST['CurrencyID'].",";
			}
			$TheSql.=" StatusID =".$_POST['StatusID'].",";
			$TheSql.=" Modified = NOW(),";
			$TheSql.=" ModifiedBy ='".trim($_SESSION['User']['FullName'])."'";
			$TheSql.=" WHERE InvoiceID =".$InvoiceID;
			$TheSql.=" AND CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
      $res = $this->connection()->execute($TheSql);
      //return $res->lastInsertId();
      return $InvoiceID;
		}

		public function PayInvoice($InvoiceID = 0, $AuthNumber='', $TransactionID = 0){
			$TheSql =" UPDATE Invoices";
			$TheSql.=" SET ";
			$TheSql.=" AuthNumber ='".$AuthNumber."',";
			$TheSql.=" PaidDate = NOW(),";
			$TheSql.=" StatusID = 3,";
			$TheSql.=" TransactionID = ".$TransactionID.",";
			$TheSql.=" Modified = NOW(),";
			$TheSql.=" ModifiedBy ='".trim($_SESSION['User']['FullName'])."'";
			$TheSql.=" WHERE InvoiceID =".$InvoiceID;
			$TheSql.=" AND CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
      $res = $this->connection()->execute($TheSql);
      //return $res->lastInsertId();
      return $InvoiceID;
		}


		public function UpdateInvoiceStatus($InvoiceID = 0, $StatusID = 0, $AuthNumber = null){
			$TheSql =" UPDATE Invoices";
			$TheSql.=" SET StatusID ='".$StatusID."'";
			if($AuthNumber){
				$TheSql.=", AuthNumber ='".$AuthNumber."',";
				$TheSql.=" PaidDate = NOW()";
			}
			$TheSql.=" WHERE InvoiceID =".$InvoiceID;
			if(isset($_SESSION['Company']['CurrentCompanyID'])){
				$TheSql.=" AND CompanyID = ".$_SESSION['Company']['CurrentCompanyID'];
			}
      $res = $this->connection()->execute($TheSql);
      //return $res->lastInsertId();
      return $InvoiceID;
		}

		public function DeleteInvoiceDetail($InvoiceID){
			$TheSql =" DELETE FROM InvoiceDetail ";
			$TheSql.=" WHERE InvoiceID = ".$InvoiceID;
			$res = $this->connection()->execute($TheSql);
			return $res;
		}

		public function DeleteInvoice($InvoiceID){
			$TheSql =" UPDATE Invoices ";
			$TheSql.=" SET StatusID = 6 ";
			$TheSql.=" WHERE InvoiceID = ".$InvoiceID;
      $res = $this->connection()->execute($TheSql);
      return $res;
		}

		public function GetInvoice($InvoiceID=0, $StatusID = null){
			$TheSql =" SELECT * ";
			$TheSql.=" FROM Invoices ";
			$TheSql.=" INNER JOIN Companies ON Invoices.CompanyID =  Companies.CompanyID";
			$TheSql.=" WHERE InvoiceID =".$InvoiceID;
			if($StatusID){
				$TheSql.=" AND StatusID in(2,3)";
			}
      $res = $this->connection()->execute($TheSql)->fetchAll('assoc');
			return $res;
		}

		public function GetInvoiceDetail($InvoiceID=0){
			$TheSql =" SELECT * ";
			$TheSql.=" FROM InvoiceDetail ";
			$TheSql.=" WHERE InvoiceID =".$InvoiceID;
			$TheSql.=" ORDER BY InvoiceDetailID ";
      $res = $this->connection()->execute($TheSql)->fetchAll('assoc');
			return $res;
		}

		public function GetInvoiceLog($InvoiceID =0, $ActionID = null){
			$TheSql =" SELECT * ";
			$TheSql.=" FROM InvoiceLog";
			$TheSql.=" INNER JOIN Actions ON InvoiceLog.ActionID = Actions.ActionID ";
			$TheSql.=" WHERE InvoiceID =".$InvoiceID;
			if($ActionID){
				$TheSql.=" AND  Actions.ActionID  =".$ActionID;
			}
			$TheSql.=" ORDER BY ActionDate ";
      $res = $this->connection()->execute($TheSql)->fetchAll('assoc');
			return $res;
		}
}
