<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Type\SynthesizeOption;
use PHPUnit\Framework\TestCase;

class SynthesizeOptionTest extends TestCase {

	protected $objSynthesizeOption;

	protected function setUp(): void{
		$this->objSynthesizeOption = new SynthesizeOption();
	}

	public function testAllowedProperties(){
		$arrProperties = array_flip($this->objSynthesizeOption->keys());
		$this->assertArrayHasKey('type', $arrProperties);
		$this->assertArrayHasKey('default', $arrProperties);
		$this->assertArrayHasKey('min', $arrProperties);
		$this->assertArrayHasKey('max', $arrProperties);
		$this->assertArrayHasKey('format', $arrProperties);
		$this->assertArrayHasKey('class', $arrProperties);
		$this->assertArrayHasKey('json', $arrProperties);
		$this->assertArrayHasKey('jsonnull', $arrProperties);
		$this->assertArrayHasKey('autoinit', $arrProperties);

		$this->assertEquals(array('type','default','min','max','format','class','json','jsonnull','autoinit'), $this->objSynthesizeOption->keys());
	}
}