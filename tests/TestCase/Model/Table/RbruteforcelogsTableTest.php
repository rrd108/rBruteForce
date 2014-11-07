<?php
namespace RBruteForce\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use RBruteForce\Model\Table\RbruteforcelogsTable;
use Cake\TestSuite\TestCase;

/**
 * RBruteForce\Model\Table\RbruteforcelogsTable Test Case
 */
class RbruteforcelogsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'plugin.r_brute_force.rbruteforcelogs'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Rbruteforcelogs') ? [] : ['className' => 'RBruteForce\Model\Table\RbruteforcelogsTable'];
		$this->Rbruteforcelogs = TableRegistry::get('Rbruteforcelogs', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rbruteforcelogs);

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
