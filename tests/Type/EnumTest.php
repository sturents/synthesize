<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\EnumFixture;
use Frozensheep\Synthesize\Tests\Type\Fixtures\BadEnumFixture;
use Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture;

class EnumTest extends \PHPUnit_Framework_TestCase {

	protected $objEnum;
	protected $objBadEnum;

	protected function setUp(){
		$this->objEnum = new EnumFixture();
		$this->objBadEnum = new BadEnumFixture();
	}

	public function testNullOnCreate(){
		$this->assertEquals(null, $this->objEnum->enum);
	}

	public function testAllowedInt(){
		$this->objEnum->enum = 4;
		$this->assertEquals(4, $this->objEnum->enum);
	}

	public function testAllowedConst(){
		$this->objEnum->enum = MonthsFixture::January;
		$this->assertEquals(1, $this->objEnum->enum);
	}

	public function testUnknownEnum(){
		$this->setExpectedException('UnexpectedValueException');
		$this->objEnum->enum = 13;
	}

	public function testBadValue(){
		$this->setExpectedException('UnexpectedValueException');
		$this->objEnum->enum = 'hello';
	}

	public function testNull(){
		$this->objEnum->enum = null;
		$this->assertNull($this->objEnum->enum);
	}

	public function testDefault(){
		$this->assertEquals(5, $this->objEnum->enum2);
		$this->assertNull($this->objEnum->enum3);
	}

	public function testMissingClassOption(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\MissingOptionException');
		$this->objBadEnum->enum = 1;
	}

	public function testAutoInit(){
		$this->assertNull($this->objEnum->enum6);

		$this->objEnum->enum6 = 2;
		$this->assertEquals(2, $this->objEnum->enum6);

		$this->objEnum->enum6 = null;
		$this->assertNull($this->objEnum->enum6);
	}

	public function testJSONOutput(){
		$this->objEnum->enum = 1;
		$this->objEnum->enum2 = null;
		$this->objEnum->enum3 = null;
		$this->objEnum->enum4 = null;
		$this->objEnum->enum5 = null;
		$this->objEnum->enum6 = null;

		//object4 is null and object6 is set
		$strExpecetedJSON = '{"enum":1,"enum4":null}';
		$strJSON = json_encode($this->objEnum);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objEnum->enum = 1;
		$this->objEnum->enum2 = null;
		$this->objEnum->enum3 = null;
		$this->objEnum->enum4 = null;
		$this->objEnum->enum5 = 3;
		$this->objEnum->enum6 = null;

		//object 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"enum":1,"enum4":null}';
		$strJSON = json_encode($this->objEnum);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objEnum->enum = null;
		$this->objEnum->enum2 = null;
		$this->objEnum->enum3 = null;
		$this->objEnum->enum4 = null;
		$this->objEnum->enum5 = null;
		$this->objEnum->enum6 = null;

		//everything is null - only enum4 shows null
		$strExpecetedJSON = '{"enum4":null}';
		$strJSON = json_encode($this->objEnum);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}