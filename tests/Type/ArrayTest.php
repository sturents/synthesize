<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\ArrayFixture;
use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase {

	protected $objArray;

	protected function setUp(): void{
		$this->objArray = new ArrayFixture();
	}

	public function testEmptyArrayOnCreate(){
		$this->assertEquals(0, $this->objArray->array()->count());
		$this->assertEquals(array(), $this->objArray->array);
		$this->assertInstanceOf('Frozensheep\Synthesize\Type\ArrayObject', $this->objArray->array());
	}

	public function testPossitiveInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = 4;
	}

	public function testNagativeInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = -4;
	}

	public function testZero(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = 0;
	}

	public function testNull(){
		$this->objArray->array = null;
		$this->assertEquals(0, count($this->objArray->array));
	}

	public function testFloat(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = 4.5;
	}

	public function testNegtiveFloat(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = -4.5;
	}

	public function testString(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = 'hello';
	}

	public function testStringInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array = '4';
	}

	public function testArray(){
		$arrOne = array();
		$arrTwo = array(1,2,3);

		$this->objArray->array = $arrOne;
		$this->assertEquals($arrOne, $this->objArray->array);
		$this->assertEquals(0, count($this->objArray->array));

		$this->objArray->array = $arrTwo;
		$this->assertEquals(3, count($this->objArray->array));
	}

	public function testObject(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objArray->array1 = new \DateTime();
	}

	public function testDefault(){
		$this->assertEquals(array(1,2,3,4,5), $this->objArray->array1);
		$this->assertEquals(5, count($this->objArray->array1));
	}

	public function testCount(){
		$this->assertEquals(5, $this->objArray->array1()->count());
	}

	public function testMaxEquals(){
		$this->objArray->array2 = array(1,2,3);
		$this->assertEquals(array(1,2,3), $this->objArray->array2);
		$this->assertEquals(3, count($this->objArray->array2));

		$this->objArray->array2 = array();
		$this->objArray->array2()[] = 1;
		$this->objArray->array2()[] = 2;
		$this->objArray->array2()[] = 3;
		$this->assertEquals(array(1,2,3), $this->objArray->array2);
		$this->assertEquals(3, count($this->objArray->array2));
	}

	public function testMaxAbove(){
		$this->expectException('Frozensheep\Synthesize\Exception\MaxException');
		$this->objArray->array2 = array();
		$this->objArray->array2()[] = 1;
		$this->objArray->array2()[] = 2;
		$this->objArray->array2()[] = 3;
		$this->objArray->array2()[] = 4;
	}

	public function testMaxBelow(){
		$this->objArray->array2 = array(1,2);
		$this->assertEquals(array(1,2), $this->objArray->array2);
		$this->assertEquals(2, count($this->objArray->array2));

		$this->objArray->array2 = array();
		$this->objArray->array2()[] = 1;
		$this->objArray->array2()[] = 2;
		$this->assertEquals(array(1,2), $this->objArray->array2);
		$this->assertEquals(2, count($this->objArray->array2));
	}

	public function testJSONOutput(){
		$this->objArray->array = array(1,2,3);
		$this->objArray->array2 = null;
		$this->objArray->array3 = null;
		$this->objArray->array4 = null;

		//array and array1 are set
		$strExpecetedJSON = '{"array":[1,2,3],"array1":[1,2,3,4,5],"array3":null}';
		$strJSON = json_encode($this->objArray);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objArray->array = null;
		$this->objArray->array1 = null;
		$this->objArray->array2 = null;
		$this->objArray->array3 = null;
		$this->objArray->array4 = array(1,2,3);

		//array 4 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"array3":null}';
		$strJSON = json_encode($this->objArray);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objArray->array = null;
		$this->objArray->array1 = null;
		$this->objArray->array2 = null;
		$this->objArray->array3 = null;
		$this->objArray->array4 = null;

		//everything is null - only array3 shows null
		$strExpecetedJSON = '{"array3":null}';
		$strJSON = json_encode($this->objArray);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}