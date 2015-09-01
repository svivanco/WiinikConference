<?php
App::uses('AppModel', 'Model');
/**
 * CoMenu Model
 *
 * @property CoMenu $MenuPadre
 * @property CoMenu $MenusHijos
 * @property CoGroup $CoGroup
 */
class CoMenu extends AppModel {

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
		'posicion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => '*Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => '*Campo de tipo numerico',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'nombre' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => '*Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'destino' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => '*Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MenuPadre' => array(
			'className' => 'CoMenu',
			'foreignKey' => 'co_menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MenusHijos' => array(
			'className' => 'CoMenu',
			'foreignKey' => 'co_menu_id',
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
		'CoGroup' => array(
			'className' => 'CoGroup',
			'joinTable' => 'co_groups_co_menus',
			'foreignKey' => 'co_menu_id',
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
