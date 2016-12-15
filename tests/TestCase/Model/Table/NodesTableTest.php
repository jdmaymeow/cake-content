<?php
namespace CakeContent\Test\TestCase\Model\Table;

use CakeContent\Model\Table\NodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * CakeContent\Model\Table\NodesTable Test Case
 */
class NodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CakeContent\Model\Table\NodesTable
     */
    public $Nodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.cake_content.nodes',
        'plugin.cake_content.users',
        'plugin.cake_content.terms',
        'plugin.cake_content.tags',
        'plugin.cake_content.nodes_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Nodes') ? [] : ['className' => 'CakeContent\Model\Table\NodesTable'];
        $this->Nodes = TableRegistry::get('Nodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Nodes);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
