<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompanyCurrenciesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompanyCurrenciesTable Test Case
 */
class CompanyCurrenciesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompanyCurrenciesTable
     */
    public $CompanyCurrencies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.company_currencies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CompanyCurrencies') ? [] : ['className' => 'App\Model\Table\CompanyCurrenciesTable'];
        $this->CompanyCurrencies = TableRegistry::get('CompanyCurrencies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompanyCurrencies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
