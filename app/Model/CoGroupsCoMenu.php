<?php
App::uses('AppModel', 'Model');
/**
 * CoGroupsCoMenu Model
 *
 * @property CoGroup $CoGroup
 * @property CoMenu $CoMenu
 */
class CoGroupsCoMenu extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'co_menu_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CoGroup' => array(
			'className' => 'CoGroup',
			'foreignKey' => 'co_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CoMenu' => array(
			'className' => 'CoMenu',
			'foreignKey' => 'co_menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
