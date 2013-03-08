<?php

App::uses('Permission', 'Model');

class ObjectPermission extends Permission {

	const ALLOW = 1;
	const DENY = -1;
	const INHERIT = 0;

	/**
	 * Overwrite Permission name.
	 *
	 * @var string
	 */
	public $name = 'ObjectPermission';

	/**
	 * Disable recursion.
	 *
	 * @var int
	 */
	public $recursive = -1;

	/**
	 * Belongs to.
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'RequestObject' => array(
			'className' => 'Admin.RequestObject',
			'foreignKey' => 'aro_id'
		),
		'ControlObject' => array(
			'className' => 'Admin.ControlObject',
			'foreignKey' => 'aco_id'
		)
	);

	/**
	 * Behaviors.
	 *
	 * @var array
	 */
	public $actsAs = array(
		'Utility.Enumerable' => array(
			'format' => 'append'
		)
	);

	/**
	 * Enumerable fields.
	 *
	 * @var array
	 */
	public $enum = array(
		'_create' => array(
			self::ALLOW => 'ALLOW',
			self::DENY => 'DENY',
			self::INHERIT => 'INHERIT'
		),
		'_read' => array(
			self::ALLOW => 'ALLOW',
			self::DENY => 'DENY',
			self::INHERIT => 'INHERIT'
		),
		'_update' => array(
			self::ALLOW => 'ALLOW',
			self::DENY => 'DENY',
			self::INHERIT => 'INHERIT'
		),
		'_delete' => array(
			self::ALLOW => 'ALLOW',
			self::DENY => 'DENY',
			self::INHERIT => 'INHERIT'
		)
	);

	/**
	 * Return all records.
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->find('all', array(
			'cache' => __METHOD__,
			'cacheExpires' => '+1 hour'
		));
	}

}