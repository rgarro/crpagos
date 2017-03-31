<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CrypterComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CrypterComponent Test Case
 */
class CrypterComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\CrypterComponent
     */
    public $Crypter;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Crypter = new CrypterComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Crypter);

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
