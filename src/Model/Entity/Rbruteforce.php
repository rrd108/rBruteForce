<?php
namespace RBruteForce\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rbruteforce Entity.
 */
class Rbruteforce extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'ip' => true,
		'url' => true,
        'expire' => true
	];

}
