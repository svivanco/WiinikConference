<?php
App::uses('AppModel', 'Model');
/**
 * CoGroup Model
 *
 * @property CoUser $CoUser
 * @property CoMenu $CoMenu
 * @property CoPermission $CoPermission
 */
class CoGroup extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';
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
		'pagina_inicio' => array(
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
		'CoUser' => array(
			'className' => 'CoUser',
			'foreignKey' => 'co_group_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'CoMenu' => array(
			'className' => 'CoMenu',
			'joinTable' => 'co_groups_co_menus',
			'foreignKey' => 'co_group_id',
			'associationForeignKey' => 'co_menu_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'CoPermission' => array(
			'className' => 'CoPermission',
			'joinTable' => 'co_groups_co_permissions',
			'foreignKey' => 'co_group_id',
			'associationForeignKey' => 'co_permission_id',
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
