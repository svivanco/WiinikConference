<?php
App::uses('AppModel', 'Model');
/**
 * CoGroupsCoPermission Model
 *
 * @property CoGroup $CoGroup
 * @property CoPermission $CoPermission
 */
class CoGroupsCoPermission extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'co_permission_id';


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
		'CoPermission' => array(
			'className' => 'CoPermission',
			'foreignKey' => 'co_permission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
