<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.access_levels'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Users') ? [] : ['className' => 'App\Model\Table\UsersTable'];
        $this->Users = TableRegistry::get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

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

    /**
     * Test allByCompanyID method
     *
     * @return void
     */
    public function testAllByCompanyID()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test CheckCompany method
     *
     * @return void
     */
    public function testCheckCompany()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test GetUsers method
     *
     * @return void
     */
    public function testGetUsers()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test FindUserByEmail method
     *
     * @return void
     */
    public function testFindUserByEmail()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test AddNewUser method
     *
     * @return void
     */
    public function testAddNewUser()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test UpdateUser method
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test AddUserToCompany method
     *
     * @return void
     */
    public function testAddUserToCompany()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test SaveMySettings method
     *
     * @return void
     */
    public function testSaveMySettings()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
