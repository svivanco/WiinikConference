<?php
/**
 * MunicipioFixture
 *
 */
class MunicipioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'entidade_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'clave' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 3, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'zoom' => array('type' => 'integer', 'null' => true, 'default' => null),
		'latlong' => array('type' => 'integer', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id', 'entidade_id'), 'unique' => 1),
			'fk_municipios_entidades1_idx' => array('column' => 'entidade_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'entidade_id' => 1,
			'clave' => 'L',
			'nombre' => 'Lorem ipsum dolor sit amet',
			'zoom' => 1,
			'latlong' => 1
		),
	);

}
