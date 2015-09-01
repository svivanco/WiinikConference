<?php
App::uses('AppModel', 'Model');
/**
 * CoPermission Model
 *
 * @property CoGroup $CoGroup
 */
class CoPermission extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'descripcion';
	//Agrega la Funcionalidad de LOGS, para auditar las acciones CRUD
	public $actsAs = array( 'AuditLog.Auditable' );
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nombre' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'descripcion' => array(
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
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'CoGroup' => array(
			'className' => 'CoGroup',
			'joinTable' => 'co_groups_co_permissions',
			'foreignKey' => 'co_permission_id',
			'associationForeignKey' => 'co_group_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
