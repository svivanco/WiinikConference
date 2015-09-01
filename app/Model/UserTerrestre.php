<?php
App::uses('AppModel', 'Model');
/**
 * UserTerrestre Model
 *
 * @property CoUser $CoUser
 */
class UserTerrestre extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user_terrestre';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'vehiculo';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'co_user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'vehiculo' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CoUser' => array(
			'className' => 'CoUser',
			'foreignKey' => 'co_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
