<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoicesFixture
 *
 */
class InvoicesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'InvoiceID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'CompanyID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'StatusID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ClientID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CurrencyID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'LocaleCode' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'InvoiceNumber' => ['type' => 'string', 'length' => 25, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'InvoiceDate' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'Shipping' => ['type' => 'float', 'length' => 12, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'Tax' => ['type' => 'float', 'length' => 12, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'Note' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'EmailSubject' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'AuthNumber' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'VoidDate' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'PaidDate' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'Entered' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'EnteredBy' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => 'System', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ModifiedBy' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'TransactionID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'Companies_Invoices_FK' => ['type' => 'index', 'columns' => ['CompanyID'], 'length' => []],
            'Status_Invoices_FK' => ['type' => 'index', 'columns' => ['StatusID'], 'length' => []],
            'Clients_Invoices_FK' => ['type' => 'index', 'columns' => ['ClientID'], 'length' => []],
            'Currency_Invoices_FK' => ['type' => 'index', 'columns' => ['CurrencyID'], 'length' => []],
            'Invoices_Locale_FK' => ['type' => 'index', 'columns' => ['LocaleCode'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['InvoiceID'], 'length' => []],
            'Clients_Invoices_FK' => ['type' => 'foreign', 'columns' => ['ClientID'], 'references' => ['Clients', 'ClientID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'Companies_Invoices_FK' => ['type' => 'foreign', 'columns' => ['CompanyID'], 'references' => ['Companies', 'CompanyID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'Currency_Invoices_FK' => ['type' => 'foreign', 'columns' => ['CurrencyID'], 'references' => ['Currencies', 'CurrencyID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'Invoices_Locale_FK' => ['type' => 'foreign', 'columns' => ['LocaleCode'], 'references' => ['Locales', 'LocaleCode'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'Status_Invoices_FK' => ['type' => 'foreign', 'columns' => ['StatusID'], 'references' => ['Status', 'StatusID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'InvoiceID' => 1,
            'CompanyID' => 1,
            'StatusID' => 1,
            'ClientID' => 1,
            'CurrencyID' => 1,
            'LocaleCode' => 'Lorem ip',
            'InvoiceNumber' => 'Lorem ipsum dolor sit a',
            'InvoiceDate' => '2017-04-04 01:40:09',
            'Shipping' => 1,
            'Tax' => 1,
            'Note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'EmailSubject' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'AuthNumber' => 'Lorem ipsum dolor sit amet',
            'VoidDate' => '2017-04-04 01:40:09',
            'PaidDate' => '2017-04-04 01:40:09',
            'Entered' => 1491270009,
            'EnteredBy' => 'Lorem ipsum dolor sit amet',
            'Modified' => '2017-04-04 01:40:09',
            'ModifiedBy' => 'Lorem ipsum dolor sit amet',
            'TransactionID' => 1
        ],
    ];
}
