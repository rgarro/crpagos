<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientsFixture
 *
 */
class ClientsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ClientID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'CompanyID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Email' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Phone' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ClientName' => ['type' => 'string', 'length' => 30, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ClientLastName' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'CedulaJuridica' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'RazonSocial' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ClientStatus' => ['type' => 'integer', 'length' => 6, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Entered' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'EnteredBy' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => 'System', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ModifiedBy' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'Companies_Clients_FK' => ['type' => 'index', 'columns' => ['CompanyID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ClientID'], 'length' => []],
            'Companies_Clients_FK' => ['type' => 'foreign', 'columns' => ['CompanyID'], 'references' => ['Companies', 'CompanyID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'ClientID' => 1,
            'CompanyID' => 1,
            'Email' => 'Lorem ipsum dolor sit amet',
            'Phone' => 'Lorem ipsum dolor ',
            'ClientName' => 'Lorem ipsum dolor sit amet',
            'ClientLastName' => 'Lorem ipsum dolor sit amet',
            'CedulaJuridica' => 'Lorem ipsum dolor sit amet',
            'RazonSocial' => 'Lorem ipsum dolor sit amet',
            'ClientStatus' => 1,
            'Entered' => 1491269736,
            'EnteredBy' => 'Lorem ipsum dolor sit amet',
            'Modified' => '2017-04-04 01:35:36',
            'ModifiedBy' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
