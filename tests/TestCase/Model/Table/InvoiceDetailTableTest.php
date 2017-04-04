<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceDetailTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceDetailTable Test Case
 */
class InvoiceDetailTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceDetailTable
     */
    public $InvoiceDetail;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoice_detail'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InvoiceDetail') ? [] : ['className' => 'App\Model\Table\InvoiceDetailTable'];
        $this->InvoiceDetail = TableRegistry::get('InvoiceDetail', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceDetail);

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
