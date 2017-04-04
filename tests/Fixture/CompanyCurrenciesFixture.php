<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompanyCurrenciesFixture
 *
 */
class CompanyCurrenciesFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'CompanyCurrencies';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'CompanyID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CurrencyID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CurrencyOrder' => ['type' => 'integer', 'length' => 6, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'Currencies_CompanyCurrencies_FK' => ['type' => 'index', 'columns' => ['CurrencyID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['CompanyID', 'CurrencyID'], 'length' => []],
            'Company_CompanyCurrencis' => ['type' => 'foreign', 'columns' => ['CompanyID'], 'references' => ['Companies', 'CompanyID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'Currencies_CompanyCurrencies_FK' => ['type' => 'foreign', 'columns' => ['CurrencyID'], 'references' => ['Currencies', 'CurrencyID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'CompanyID' => 1,
            'CurrencyID' => 1,
            'CurrencyOrder' => 1
        ],
    ];
}
