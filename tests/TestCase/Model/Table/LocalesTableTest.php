<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LocalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LocalesTable Test Case
 */
class LocalesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LocalesTable
     */
    public $Locales;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.locales'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Locales') ? [] : ['className' => 'App\Model\Table\LocalesTable'];
        $this->Locales = TableRegistry::get('Locales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Locales);

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
