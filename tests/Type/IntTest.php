<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\IntFixture;

class IntTest extends \PHPUnit_Framework_TestCase {

	protected $objInt;

	protected function setUp(){
		$this->objInt = new IntFixture();
	}

	public function testNullOnCreate(){
		$this->assertEquals(null, $this->objInt->int);
	}

	public function testPossitiveInt(){
		$this->objInt->int1 = 4;
		$this->assertEquals(4, $this->objInt->int1);
	}

	public function testNagativeInt(){
		$this->objInt->int1 = -4;
		$this->assertEquals(-4, $this->objInt->int1);
	}

	public function testZero(){
		$this->objInt->int1 = 0;
		$this->assertEquals(0, $this->objInt->int1);
	}

	public function testNull(){
		$this->objInt->int1 = null;
		$this->assertEquals(null, $this->objInt->int1);
	}

	public function testFloat(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objInt->int1 = 4.5;
	}

	public function testNegtiveFloat(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objInt->int1 = -4.5;
	}

	public function testString(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objInt->int1 = 'hello';
	}

	public function testStringInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objInt->int1 = '4';
	}

	public function testArray(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objInt->int1 = array();
	}

	public function testObject(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objInt->int1 = new \DateTime();
	}

	public function testInvalidSynthesize(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\SynthesizeException');
		$this->objInt->fake = 4;
	}

	public function testDefault(){
		$this->assertEquals(15, $this->objInt->int2);
	}

	public function testMinEquals(){
		$this->objInt->int3 = 0;
		$this->assertEquals(0, $this->objInt->int3);
	}

	public function testMinAbove(){
		$this->objInt->int3 = 1;
		$this->assertEquals(1, $this->objInt->int3);
	}

	public function testMinBelow(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\RangeException');
		$this->objInt->int3 = -1;
	}

	public function testMaxEquals(){
		$this->objInt->int3 = 10;
		$this->assertEquals(10, $this->objInt->int3);
	}

	public function testMaxAbove(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\RangeException');
		$this->objInt->int3 = 11;
	}

	public function testMaxBelow(){
		$this->objInt->int3 = 9;
		$this->assertEquals(9, $this->objInt->int3);
	}

	public function testJSON(){
		$this->objInt->int = null;
		$this->objInt->int2 = null;
		$this->objInt->int3 = null;
		$this->objInt->int4 = null;
		$this->objInt->int5 = null;

		//everything is null - only int4 shows null
		$strExpecetedJSON = '{"int4":null}';
		$strJSON = json_encode($this->objInt);
		$this->assertEquals($strExpecetedJSON, $strJSON);

		//int is set to 5
		$this->objInt->int = 5;
		$strExpecetedJSON = '{"int":5,"int4":null}';
		$strJSON = json_encode($this->objInt);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONOutput(){
		$this->objInt->int = 5;
		$this->objInt->int2 = -3;
		$this->objInt->int3 = null;
		$this->objInt->int4 = null;
		$this->objInt->int5 = null;

		//int and int2 are set
		$strExpecetedJSON = '{"int":5,"int2":-3,"int4":null}';
		$strJSON = json_encode($this->objInt);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objInt->int = 5;
		$this->objInt->int2 = -3;
		$this->objInt->int3 = null;
		$this->objInt->int4 = null;
		$this->objInt->int5 = 7;

		//int 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"int":5,"int2":-3,"int4":null}';
		$strJSON = json_encode($this->objInt);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objInt->int = null;
		$this->objInt->int2 = null;
		$this->objInt->int3 = null;
		$this->objInt->int4 = null;
		$this->objInt->int5 = null;

		//everything is null - only int4 shows null
		$strExpecetedJSON = '{"int4":null}';
		$strJSON = json_encode($this->objInt);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}