<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\ArrayFixture;

class ArrayTest extends \PHPUnit_Framework_TestCase {

	protected $objArray;

	protected function setUp(){
		$this->objArray = new ArrayFixture();
	}

	public function testEmptyArrayOnCreate(){
		$this->assertEquals(array(), $this->objArray->array);
		$this->assertEquals(0, count($this->objArray->array));
	}

	public function testPossitiveInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = 4;
	}

	public function testNagativeInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = -4;
	}

	public function testZero(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = 0;
	}

	public function testNull(){
		$this->objArray->array = null;
		$this->assertEquals(0, count($this->objArray->array));
	}

	public function testFloat(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = 4.5;
	}

	public function testNegtiveFloat(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = -4.5;
	}

	public function testString(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = 'hello';
	}

	public function testStringInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = '4';
	}

	public function testArray(){
		$arrOne = array();
		$arrTwo = array(1,2,3);

		$this->objArray->array = $arrOne;
		$this->assertEquals($arrOne, $this->objArray->array);
		$this->assertEquals(0, count($this->objArray->array));

		$this->objArray->array = $arrTwo;
		$this->assertEquals($arrTwo, $this->objArray->array);
		$this->assertEquals(3, count($this->objArray->array));
	}

	public function testObject(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array1 = new \DateTime();
	}

	public function testDefault(){
		$this->assertEquals(15.72, $this->objArray->array2);
	}

	public function testMinEquals(){
		$this->objArray->array3 = 0.0;
		$this->assertEquals(0, $this->objArray->array3);
	}

	public function testMinAbove(){
		$this->objArray->array3 = 1.27;
		$this->assertEquals(1.27, $this->objArray->array3);
	}

	public function testMinBelow(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\RangeException');
		$this->objArray->array3 = -1.27;
	}

	public function testMaxEquals(){
		$this->objArray->array3 = 10.0;
		$this->assertEquals(10, $this->objArray->array3);
	}

	public function testMaxAbove(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\RangeException');
		$this->objArray->array3 = 11.87;
	}

	public function testMaxBelow(){
		$this->objArray->array3 = 9.1876;
		$this->assertEquals(9.1876, $this->objArray->array3);
	}

	public function testJSONOutput(){
		$this->objArray->array = 5.0;
		$this->objArray->array2 = -3.2;
		$this->objArray->array3 = null;
		$this->objArray->array4 = null;
		$this->objArray->array5 = null;

		//int and int2 are set
		$strExpecetedJSON = '{"float":5,"float2":-3.2,"float4":null}';
		$strJSON = json_encode($this->objArray);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objArray->array = 5.0;
		$this->objArray->array2 = -3.2;
		$this->objArray->array3 = null;
		$this->objArray->array4 = null;
		$this->objArray->array5 = 7.1;

		//float 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"float":5,"float2":-3.2,"float4":null}';
		$strJSON = json_encode($this->objArray);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objArray->array = null;
		$this->objArray->array2 = null;
		$this->objArray->array3 = null;
		$this->objArray->array4 = null;
		$this->objArray->array5 = null;

		//everything is null - only float4 shows null
		$strExpecetedJSON = '{"float4":null}';
		$strJSON = json_encode($this->objArray);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}