<?php
namespace RBruteForce\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use RBruteForce\Model\Table\RbruteforcesTable;
use Cake\TestSuite\TestCase;

/**
 * RBruteForce\Model\Table\RbruteforcesTable Test Case
 */
class RbruteforcesTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'plugin.r_brute_force.rbruteforces'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Rbruteforces') ? [] : ['className' => 'RBruteForce\Model\Table\RbruteforcesTable'];
		$this->Rbruteforces = TableRegistry::get('Rbruteforces', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rbruteforces);

		parent::tearDown();
	}

/**
 * Test initialize method
 *
 * @return void
 */
	public function testInitialize() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test validationDefault method
 *
 * @return void
 */
	public function testValidationDefault() {
		$this->markTestIncomplete('Not implemented yet.');
	}

}
