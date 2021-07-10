<?php
namespace RBruteForce\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rbruteforces Model
 */
class RbruteforcesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->setTable('rbruteforces');
		$this->setDisplayField('expire');
		$this->setPrimaryKey('expire');
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->requirePresence('ip', 'create')
			->notEmpty('ip')
			->requirePresence('url', 'create')
			->notEmpty('url')
			->requirePresence('expire', 'create')
			->notEmpty('expire', 'create');

		return $validator;
	}

	public function cleanupAttempts($maxRow){
		$expire = $this->find()
			->select(['expire'])
			->order(['expire' => 'DESC'])
			->limit($maxRow);
		$expire = $expire->toArray();
		$expire = array_pop($expire);
		$this->deleteAll(['expire < ' => $expire->expire]);
	}
}
