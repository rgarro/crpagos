<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoiceLogFixture
 *
 */
class InvoiceLogFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'InvoiceLog';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'LogID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'InvoiceID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ActionID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ActionDate' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'ActionBy' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'IP' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Comment' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'Invoices_InvoiceLog_FK' => ['type' => 'index', 'columns' => ['InvoiceID'], 'length' => []],
            'Actions_InvoiceLog_FK' => ['type' => 'index', 'columns' => ['ActionID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['LogID'], 'length' => []],
            'Actions_InvoiceLog_FK' => ['type' => 'foreign', 'columns' => ['ActionID'], 'references' => ['Actions', 'ActionID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'Invoices_InvoiceLog_FK' => ['type' => 'foreign', 'columns' => ['InvoiceID'], 'references' => ['Invoices', 'InvoiceID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'LogID' => 1,
            'InvoiceID' => 1,
            'ActionID' => 1,
            'ActionDate' => 1491269992,
            'ActionBy' => 'Lorem ipsum dolor sit amet',
            'IP' => 'Lorem ipsum dolor ',
            'Comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
        ],
    ];
}
