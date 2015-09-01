<?php
App::uses('Municipio', 'Model');

/**
 * Municipio Test Case
 *
 */
class MunicipioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.municipio',
		'app.entidade',
		'app.co_user',
		'app.co_group',
		'app.co_menu',
		'app.co_groups_co_menu',
		'app.co_permission',
		'app.co_groups_co_permission',
		'app.direccione',
		'app.usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Municipio = ClassRegistry::init('Municipio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Municipio);

		parent::tearDown();
	}

}
