<?php
App::uses('AppModel', 'Model');
/**
 * UserSexo Model
 *
 * @property UserData $UserData
 */
class UserSexo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'sexo';
//Agrega la Funcionalidad de LOGS, para auditar las acciones CRUD
public $actsAs = array( 'AuditLog.Auditable' );
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'letra' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'UserData' => array(
			'className' => 'UserData',
			'foreignKey' => 'user_sexo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
