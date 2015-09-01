<?php
App::uses('Telefono', 'Model');

/**
 * Telefono Test Case
 *
 */
class TelefonoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.telefono',
		'app.municipio',
		'app.entidade',
		'app.co_user',
		'app.co_group',
		'app.co_menu',
		'app.co_groups_co_menu',
		'app.co_permission',
		'app.co_groups_co_permission',
		'app.direccione',
		'app.webuser',
		'app.titulo',
		'app.usuario',
		'app.area',
		'app.cargo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Telefono = ClassRegistry::init('Telefono');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Telefono);

		parent::tearDown();
	}

}
