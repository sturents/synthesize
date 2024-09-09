<?php

namespace Frozensheep\Synthesize\Tests;

use Frozensheep\Synthesize\Tests\Type\Fixtures\IdFixture;
use PHPUnit\Framework\TestCase;

class SynthesizeTest extends TestCase {

	protected $objSynthesize;

	protected function setUp(): void{
		$this->objSynthesize = new IdFixture();
	}

	public function testGet(){

		$this->markTestIncomplete();
	}
}