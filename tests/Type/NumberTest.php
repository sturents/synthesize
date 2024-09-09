<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\NumberFixture;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase {

	protected $objNumber;

	protected function setUp(): void{
		$this->objNumber = new NumberFixture();
	}

	public function testNullOnCreate(){
		$this->assertEquals(null, $this->objNumber->num);
	}

	public function testPossitiveInt(){
		$this->objNumber->num1 = 4;
		$this->assertEquals(4, $this->objNumber->num1);
	}

	public function testNagativeInt(){
		$this->objNumber->num1 = -4;
		$this->assertEquals(-4, $this->objNumber->num1);
	}

	public function testZero(){
		$this->objNumber->num1 = 0;
		$this->assertEquals(0, $this->objNumber->num1);
	}

	public function testNull(){
		$this->objNumber->num1 = null;
		$this->assertEquals(null, $this->objNumber->num1);
	}

	public function testFloat(){
		$this->objNumber->num1 = 4.5;
		$this->assertEquals(4.5, $this->objNumber->num1);
	}

	public function testNegtiveFloat(){
		$this->objNumber->num1 = -4.5;
		$this->assertEquals(-4.5, $this->objNumber->num1);
	}

	public function testString(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objNumber->num1 = 'hello';
	}

	public function testStringInt(){
		$this->objNumber->num1 = '4';
		$this->assertEquals(4, $this->objNumber->num1);
	}

	public function testArray(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objNumber->num1 = array();
	}

	public function testObject(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objNumber->num1 = new \DateTime();
	}

	public function testDefault(){
		$this->assertEquals(15, $this->objNumber->num2);
	}

	public function testMinEquals(){
		$this->objNumber->num3 = 0;
		$this->assertEquals(0, $this->objNumber->num3);
	}

	public function testMinAbove(){
		$this->objNumber->num3 = 1;
		$this->assertEquals(1, $this->objNumber->num3);
	}

	public function testMinBelow(){
		$this->expectException('Frozensheep\Synthesize\Exception\RangeException');
		$this->objNumber->num3 = -1;
	}

	public function testMaxEquals(){
		$this->objNumber->num3 = 10;
		$this->assertEquals(10, $this->objNumber->num3);
	}

	public function testMaxAbove(){
		$this->expectException('Frozensheep\Synthesize\Exception\RangeException');
		$this->objNumber->num3 = 11;
	}

	public function testMaxBelow(){
		$this->objNumber->num3 = 9;
		$this->assertEquals(9, $this->objNumber->num3);
	}

	public function testJSONOutput(){
		$this->objNumber->num = 5;
		$this->objNumber->num2 = -3;
		$this->objNumber->num3 = null;
		$this->objNumber->num4 = null;
		$this->objNumber->num5 = null;

		//int and int2 are set
		$strExpecetedJSON = '{"num":5,"num2":-3,"num4":null}';
		$strJSON = json_encode($this->objNumber);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objNumber->num = 5;
		$this->objNumber->num2 = -3;
		$this->objNumber->num3 = null;
		$this->objNumber->num4 = null;
		$this->objNumber->num5 = 7;

		//int 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"num":5,"num2":-3,"num4":null}';
		$strJSON = json_encode($this->objNumber);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objNumber->num = null;
		$this->objNumber->num2 = null;
		$this->objNumber->num3 = null;
		$this->objNumber->num4 = null;
		$this->objNumber->num5 = null;

		//everything is null - only int4 shows null
		$strExpecetedJSON = '{"num4":null}';
		$strJSON = json_encode($this->objNumber);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}