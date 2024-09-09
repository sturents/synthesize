<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\FloatFixture;
use PHPUnit\Framework\TestCase;

class FloatTest extends TestCase {

	protected $objFloat;

	protected function setUp(): void{
		$this->objFloat = new FloatFixture();
	}

	public function testNullOnCreate(){
		$this->assertEquals(null, $this->objFloat->float);
	}

	public function testPossitiveInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objFloat->float1 = 4;
	}

	public function testNagativeInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objFloat->float1 = -4;
	}

	public function testZero(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objFloat->float1 = 0;
	}

	public function testNull(){
		$this->objFloat->float1 = null;
		$this->assertEquals(null, $this->objFloat->float1);
	}

	public function testFloat(){
		$this->objFloat->float1 = 4.5;
		$this->assertEquals(4.5, $this->objFloat->float1);

		$this->objFloat->float1 = 4.0;
		$this->assertEquals(4.0, $this->objFloat->float1);

		$this->objFloat->float1 = 4.123456789;
		$this->assertEquals(4.123456789, $this->objFloat->float1);
	}

	public function testNegtiveFloat(){
		$this->objFloat->float1 = -4.5;
		$this->assertEquals(-4.5, $this->objFloat->float1);

		$this->objFloat->float1 = -4.0;
		$this->assertEquals(-4.0, $this->objFloat->float1);

		$this->objFloat->float1 = -4.123456789;
		$this->assertEquals(-4.123456789, $this->objFloat->float1);
	}

	public function testString(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objFloat->float1 = 'hello';
	}

	public function testStringInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objFloat->float1 = '4';
	}

	public function testArray(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objFloat->float1 = array();
	}

	public function testObject(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objFloat->float1 = new \DateTime();
	}

	public function testDefault(){
		$this->assertEquals(15.72, $this->objFloat->float2);
	}

	public function testMinEquals(){
		$this->objFloat->float3 = 0.0;
		$this->assertEquals(0, $this->objFloat->float3);
	}

	public function testMinAbove(){
		$this->objFloat->float3 = 1.27;
		$this->assertEquals(1.27, $this->objFloat->float3);
	}

	public function testMinBelow(){
		$this->expectException('Frozensheep\Synthesize\Exception\RangeException');
		$this->objFloat->float3 = -1.27;
	}

	public function testMaxEquals(){
		$this->objFloat->float3 = 10.0;
		$this->assertEquals(10, $this->objFloat->float3);
	}

	public function testMaxAbove(){
		$this->expectException('Frozensheep\Synthesize\Exception\RangeException');
		$this->objFloat->float3 = 11.87;
	}

	public function testMaxBelow(){
		$this->objFloat->float3 = 9.1876;
		$this->assertEquals(9.1876, $this->objFloat->float3);
	}

	public function testJSONOutput(){
		$this->objFloat->float = 5.0;
		$this->objFloat->float2 = -3.2;
		$this->objFloat->float3 = null;
		$this->objFloat->float4 = null;
		$this->objFloat->float5 = null;

		//int and int2 are set
		$strExpecetedJSON = '{"float":5,"float2":-3.2,"float4":null}';
		$strJSON = json_encode($this->objFloat);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objFloat->float = 5.0;
		$this->objFloat->float2 = -3.2;
		$this->objFloat->float3 = null;
		$this->objFloat->float4 = null;
		$this->objFloat->float5 = 7.1;

		//float 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"float":5,"float2":-3.2,"float4":null}';
		$strJSON = json_encode($this->objFloat);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objFloat->float = null;
		$this->objFloat->float2 = null;
		$this->objFloat->float3 = null;
		$this->objFloat->float4 = null;
		$this->objFloat->float5 = null;

		//everything is null - only float4 shows null
		$strExpecetedJSON = '{"float4":null}';
		$strJSON = json_encode($this->objFloat);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}