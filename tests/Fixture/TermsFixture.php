<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TermsFixture
 *
 */
class TermsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'CompanyID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'LocaleCode' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Content' => ['type' => 'text', 'length' => 16777215, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'EnteredBy' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => 'System', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Entered' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'Modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ModifiedBy' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'Locale_Terms_FK' => ['type' => 'index', 'columns' => ['LocaleCode'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['CompanyID', 'LocaleCode'], 'length' => []],
            'Company_Terms_FK' => ['type' => 'foreign', 'columns' => ['CompanyID'], 'references' => ['Companies', 'CompanyID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'Locale_Terms_FK' => ['type' => 'foreign', 'columns' => ['LocaleCode'], 'references' => ['Locales', 'LocaleCode'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'LocaleCode' => 'b7c64dcb-1b3f-42c2-915f-77f245ccfc58',
            'Content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'EnteredBy' => 'Lorem ipsum dolor sit amet',
            'Entered' => 1491270053,
            'Modified' => '2017-04-04 01:40:53',
            'ModifiedBy' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
