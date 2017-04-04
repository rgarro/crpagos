<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoiceDetailFixture
 *
 */
class InvoiceDetailFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'InvoiceDetail';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'InvoiceDetailID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'InvoiceID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'UnitPrice' => ['type' => 'float', 'length' => 12, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'Qty' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Amount' => ['type' => 'float', 'length' => 12, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'Description' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Taxable' => ['type' => 'integer', 'length' => 6, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'Invoices_InvoiceDetail_FK' => ['type' => 'index', 'columns' => ['InvoiceID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['InvoiceDetailID'], 'length' => []],
            'Invoices_InvoiceDetail_FK' => ['type' => 'foreign', 'columns' => ['InvoiceID'], 'references' => ['Invoices', 'InvoiceID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'InvoiceDetailID' => 1,
            'InvoiceID' => 1,
            'UnitPrice' => 1,
            'Qty' => 1,
            'Amount' => 1,
            'Description' => 'Lorem ipsum dolor sit amet',
            'Taxable' => 1
        ],
    ];
}
