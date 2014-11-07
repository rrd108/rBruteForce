<?php
namespace RBruteForce\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RbruteforcelogsFixture
 *
 */
class RbruteforcelogsFixture extends TestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = [
		'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
		'data' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
		],
		'_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_general_ci'
		],
	];

/**
 * Records
 *
 * @var array
 */
	public $records = [
		[
			'id' => 1,
			'data' => 'a:2:{s:4:"name";s:3:"123";s:8:"password";s:3:"456";}'
		],
	];

}
