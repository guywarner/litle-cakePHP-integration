<?php
/* Sale Test cases generated on: 2012-03-12 19:31:17 : 1331580677*/
App::uses('Sale', 'Model');

/**
 * Sale Test Case
 *
 */
class SaleTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.sale');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Sale = ClassRegistry::init('Sale');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sale);

		parent::tearDown();
	}

}
