<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\BooleanFixture;
use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase {

	protected $objBoolean;

	protected function setUp(): void{
		$this->objBoolean = new BooleanFixture();
	}

	public function testNullOnCreate(){
		$this->assertEquals(null, $this->objBoolean->boolean);
	}

	public function testBooleans(){
		$this->objBoolean->boolean1 = true;
		$this->assertEquals(true, $this->objBoolean->boolean1);

		$this->objBoolean->boolean1 = false;
		$this->assertEquals(false, $this->objBoolean->boolean1);
	}

	public function testPossitiveInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = 4;
	}

	public function testNagativeInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = -4;
	}

	public function testZero(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = 0;
	}

	public function testNull(){
		$this->objBoolean->boolean1 = null;
		$this->assertEquals(null, $this->objBoolean->boolean1);
	}

	public function testFloat(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = 4.5;
	}

	public function testNegtiveFloat(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = -4.5;
	}

	public function testString(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = 'hello';
	}

	public function testStringInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = '4';
	}

	public function testArray(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = array();
	}

	public function testObject(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objBoolean->boolean1 = new \DateTime();
	}

	public function testDefault(){
		$this->assertEquals(true, $this->objBoolean->boolean2);
	}

	public function testJSONOutput(){
		$this->objBoolean->boolean = true;
		$this->objBoolean->boolean2 = false;
		$this->objBoolean->boolean4 = null;
		$this->objBoolean->boolean5 = null;

		//boolean and boolean2 are set
		$strExpecetedJSON = '{"boolean":true,"boolean2":false,"boolean4":null}';
		$strJSON = json_encode($this->objBoolean);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objBoolean->boolean = true;
		$this->objBoolean->boolean2 = false;
		$this->objBoolean->boolean4 = null;
		$this->objBoolean->boolean5 = true;

		//boolean 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"boolean":true,"boolean2":false,"boolean4":null}';
		$strJSON = json_encode($this->objBoolean);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objBoolean->boolean = null;
		$this->objBoolean->boolean2 = null;
		$this->objBoolean->boolean4 = null;
		$this->objBoolean->boolean5 = null;

		//everything is null - only boolean4 shows null
		$strExpecetedJSON = '{"boolean4":null}';
		$strJSON = json_encode($this->objBoolean);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}