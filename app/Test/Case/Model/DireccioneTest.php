<?php
App::uses('Direccione', 'Model');

/**
 * Direccione Test Case
 *
 */
class DireccioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.direccione',
		'app.municipio',
		'app.usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Direccione = ClassRegistry::init('Direccione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Direccione);

		parent::tearDown();
	}

}
