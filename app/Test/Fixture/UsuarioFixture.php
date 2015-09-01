<?php
/**
 * UsuarioFixture
 *
 */
class UsuarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'titulo_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'area_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'cargo_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'telefono_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'municipio_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'direccione_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'apepat' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'apemat' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 11, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'extension' => array('type' => 'integer', 'null' => true, 'default' => null),
		'mail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fax' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'visible_web' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'titulo_id' => 1,
			'area_id' => 1,
			'cargo_id' => 1,
			'telefono_id' => 1,
			'municipio_id' => 1,
			'direccione_id' => 1,
			'nombre' => 'Lorem ipsum dolor ',
			'apepat' => 'Lorem ips',
			'apemat' => 'Lorem ips',
			'extension' => 1,
			'mail' => 'Lorem ipsum dolor sit amet',
			'fax' => 'Lorem ipsum dolor ',
			'visible_web' => 1,
			'created' => '2014-06-05 11:19:51',
			'modified' => '2014-06-05 11:19:51'
		),
	);

}
