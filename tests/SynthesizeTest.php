<?php

namespace Frozensheep\Synthesize\Tests;

use Frozensheep\Synthesize\Tests\Type\Fixtures\IdFixture;

class SynthesizeTest extends \PHPUnit_Framework_TestCase {

	protected $objSynthesize;

	protected function setUp(){
		$this->objSynthesize = new IdFixture();
	}

	public function testGet(){

		$this->markTestIncomplete();
	}
}