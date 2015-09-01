<?php
App::uses('Usuario', 'Model');

/**
 * Usuario Test Case
 *
 */
class UsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario',
		'app.titulo',
		'app.area',
		'app.cargo',
		'app.telefono',
		'app.municipio',
		'app.entidade',
		'app.co_user',
		'app.co_group',
		'app.co_menu',
		'app.co_groups_co_menu',
		'app.co_permission',
		'app.co_groups_co_permission',
		'app.direccione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Usuario = ClassRegistry::init('Usuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usuario);

		parent::tearDown();
	}

}
