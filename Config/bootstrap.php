<?php
/**
 * @copyright	Copyright 2006-2013, Miles Johnson - http://milesj.me
 * @license		http://opensource.org/licenses/mit-license.php - Licensed under the MIT License
 * @link		http://milesj.me/code/cakephp/admin
 */

/**
 * Plugin constants.
 */
define('ADMIN_PLUGIN', dirname(__DIR__) . '/');

// User model
if (!defined('USER_MODEL')) {
	define('USER_MODEL', 'User');
}

// Table prefix
if (!defined('ADMIN_PREFIX')) {
	define('ADMIN_PREFIX', 'admin_');
}

// Database config
if (!defined('ADMIN_DATABASE')) {
	define('ADMIN_DATABASE', Configure::read('Acl.database'));
}

/**
 * Current version.
 */
Configure::write('Admin.version', file_get_contents(ADMIN_PLUGIN . 'version.md'));

/**
 * Name of the application.
 */
Configure::write('Admin.appName', __('Admin'));

/**
 * Pseudo plugin name to wrap application models in.
 */
Configure::write('Admin.coreName', 'Core');

/**
 * Alias of the administrator ARO.
 */
Configure::write('Admin.adminAlias', 'administrator');

/**
 * Ignore/restrict these models.
 */
Configure::write('Admin.ignoreModels', array());

/**
 * Enable logging of administrator actions.
 */
Configure::write('Admin.logActions', true);

/**
 * Default settings for each model.
 */
Configure::write('Admin.modelDefaults', array(
	'imageFields' => array('image'),
	'fileFields' => array('image', 'file'),
	'hideFields' => array(),
	'paginate' => array(),
	'associationLimit' => 75,
	'batchDelete' => true,
	'actionButtons' => true,
	'deletable' => true,
	'editable' => true,
	'iconClass' => ''
));

/**
 * Behavior methods to execute as process callbacks.
 */
Configure::write('Admin.behaviorCallbacks', array(
	'Tree' => array(
		'recover' => 'Recover Tree',
		'reorder' => 'Reorder Tree'
	),
	'Cacheable' => array(
		'clearCache' => 'Clear Cache'
	)
));

/**
 * Model methods to execute as process callbacks.
 * The callback method accepts a record ID as the 1st argument.
 */
Configure::write('Admin.modelCallbacks', array());

/**
 * A map of user fields that are used within this plugin. If your users table has a different naming scheme
 * for the username, email, status, etc fields, you can define their replacement here.
 */
if (!Configure::check('User.fieldMap')) {
	Configure::write('User.fieldMap', array(
		'username'	=> 'username',
		'password'	=> 'password',
		'email'		=> 'email',
		'status'	=> 'status',
		'avatar'	=> 'avatar',
		'locale'	=> 'locale',
		'timezone'	=> 'timezone'
	));
}