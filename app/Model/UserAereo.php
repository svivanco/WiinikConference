<?php
App::uses('AppModel', 'Model');
/**
 * UserAereo Model
 *
 * @property CoUser $CoUser
 * @property Aeropuerto $Aeropuerto
 */
class UserAereo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'co_user_id';

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
		'aeropuerto_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'aerolinea' => array(
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
		),
		'Aeropuerto' => array(
			'className' => 'Aeropuerto',
			'foreignKey' => 'aeropuerto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
