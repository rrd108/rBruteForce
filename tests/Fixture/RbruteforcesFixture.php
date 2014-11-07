<?php
namespace RBruteForce\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RbruteforcesFixture
 *
 */
class RbruteforcesFixture extends TestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = [
		'ip' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'url' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'expire' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
		'_indexes' => [
			'ip' => ['type' => 'index', 'columns' => ['ip'], 'length' => []],
		],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['expire'], 'length' => []],
		],
		'_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_general_ci'
		],
	];

	public function init(){
        $this->records = [
            [
             'ip' => '192.193.194.195',
             'url' => 'users/login',
             'expire' => strtotime('+5 minutes')
            ],
            [
             'ip' => '188.189.190.191',
             'url' => 'users/login',
             'expire' => strtotime('+1 minutes')
            ],
            [
             'ip' => '188.189.190.191',
             'url' => 'users',
             'expire' => strtotime('+2 minutes')
            ],
            [
             'ip' => '188.189.190.191',
             'url' => 'users/login',
             'expire' => strtotime('+4 minutes')
            ],
         ];
        parent::init();
   }

}
