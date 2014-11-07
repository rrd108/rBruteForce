<?php
namespace RBruteForce\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rbruteforcelog Entity.
 */
class Rbruteforcelog extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'data' => true,
	];

}
