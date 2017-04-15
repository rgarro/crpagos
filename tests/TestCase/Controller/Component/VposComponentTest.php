<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\VposComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\VposComponent Test Case
 */
class VposComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\VposComponent
     */
    public $Vpos;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Vpos = new VposComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vpos);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
