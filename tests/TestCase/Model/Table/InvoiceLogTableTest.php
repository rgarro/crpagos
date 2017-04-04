<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceLogTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceLogTable Test Case
 */
class InvoiceLogTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceLogTable
     */
    public $InvoiceLog;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoice_log'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InvoiceLog') ? [] : ['className' => 'App\Model\Table\InvoiceLogTable'];
        $this->InvoiceLog = TableRegistry::get('InvoiceLog', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceLog);

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
