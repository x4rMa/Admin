<?php
/**
 * @copyright	Copyright 2006-2013, Miles Johnson - http://milesj.me
 * @license		http://opensource.org/licenses/mit-license.php - Licensed under the MIT License
 * @link		http://milesj.me/code/cakephp/admin
 */

App::uses('AdminAppModel', 'Admin.Model');

class ActionLog extends AdminAppModel {

	const OTHER = 0;

	// CRUD
	const CREATE = 10;
	const READ = 11;
	const UPDATE = 12;
	const DELETE = 13;
	const BATCH_DELETE = 14;
	const PROCESS = 15;
	const BATCH_PROCESS = 16;

	// ACL
	const ACL_SYNC = 20;
	const ACL_GRANT = 21;

	/**
	 * Display field.
	 *
	 * @var string
	 */
	public $displayField = 'item';

	/**
	 * Belongs to.
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'User' => array(
			'className' => USER_MODEL
		)
	);

	/**
	 * Enum mapping.
	 *
	 * @var array
	 */
	public $enum = array(
		'action' => array(
			self::OTHER => 'OTHER',
			self::CREATE => 'CREATE',
			self::READ => 'READ',
			self::UPDATE => 'UPDATE',
			self::DELETE => 'DELETE',
			self::BATCH_DELETE => 'BATCH_DELETE',
			self::PROCESS => 'PROCESS',
			self::BATCH_PROCESS => 'BATCH_PROCESS',
			self::ACL_SYNC => 'ACL_SYNC',
			self::ACL_GRANT => 'ACL_GRANT'
		)
	);

	/**
	 * Admin settings.
	 *
	 * @var array
	 */
	public $admin = array(
		'iconClass' => 'icon-exchange',
		'editable' => false,
		'deletable' => false,
		'paginate' => array(
			'order' => array('ActionLog.id' => 'DESC')
		)
	);

	/**
	 * Log an action only once every 6 hours.
	 *
	 * @param array $query
	 * @return bool
	 */
	public function logAction($query) {
		$conditions = $query;
		$conditions['created >='] = date('Y-m-d H:i:s', strtotime('-6 hours'));

		$count = $this->find('count', array(
			'conditions' => $conditions
		));

		if ($count) {
			return true;
		}

		$this->create();

		return $this->save($query, false);
	}

	/**
	 * Remove core plugin from models.
	 *
	 * @param array $options
	 * @return bool
	 */
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['model'])) {
			list($plugin, $model) = Admin::parseName($this->data[$this->alias]['model']);

			if ($plugin === Configure::read('Admin.coreName')) {
				$this->data[$this->alias]['model'] = $model;
			}
		}

		return true;
	}

}