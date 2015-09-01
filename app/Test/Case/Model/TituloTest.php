<?php
App::uses('Titulo', 'Model');

/**
 * Titulo Test Case
 *
 */
class TituloTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.titulo',
		'app.usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Titulo = ClassRegistry::init('Titulo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Titulo);

		parent::tearDown();
	}

}
