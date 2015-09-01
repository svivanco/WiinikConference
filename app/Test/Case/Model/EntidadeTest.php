<?php
App::uses('Entidade', 'Model');

/**
 * Entidade Test Case
 *
 */
class EntidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.entidade',
		'app.co_user',
		'app.co_group',
		'app.co_menu',
		'app.co_groups_co_menu',
		'app.co_permission',
		'app.co_groups_co_permission',
		'app.municipio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Entidade = ClassRegistry::init('Entidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Entidade);

		parent::tearDown();
	}

}
