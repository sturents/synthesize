<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\StringFixture;

class StringTest extends \PHPUnit_Framework_TestCase {

	protected $objString;

	protected function setUp(){
		$this->objString = new StringFixture();
	}

	public function testNullOnCreate(){
		$this->assertEquals(null, $this->objString->string);
	}

	public function testPossitiveInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objString->string1 = 4;
	}

	public function testNagativeInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objString->string1 = -4;
	}

	public function testZero(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objString->string1 = 0;
	}

	public function testNull(){
		$this->objString->string1 = null;
		$this->assertEquals(null, $this->objString->string1);
	}

	public function testFloat(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objString->string1 = 4.5;
	}

	public function testNegtiveFloat(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objString->string1 = -4.5;
	}

	public function testString(){
		$this->objString->string1 = 'hello';
		$this->assertEquals('hello', $this->objString->string1);
	}

	public function testStringInt(){
		$this->objString->string1 = '4';
		$this->assertEquals(4, $this->objString->string1);
	}

	public function testArray(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objString->string1 = array();
	}

	public function testObject(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objString->string1 = new \DateTime();
	}

	public function testDefault(){
		$this->assertEquals('hello', $this->objString->string2);
	}

	public function testMinEquals(){
		$this->objString->string3 = 'abc';
		$this->assertEquals('abc', $this->objString->string3);
	}

	public function testMinAbove(){
		$this->objString->string3 = 'abcd';
		$this->assertEquals('abcd', $this->objString->string3);
	}

	public function testMinBelow(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\LengthException');
		$this->objString->string3 = 'ab';
	}

	public function testMaxEquals(){
		$this->objString->string3 = 'abcdefghij';
		$this->assertEquals('abcdefghij', $this->objString->string3);
	}

	public function testMaxAbove(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\LengthException');
		$this->objString->string3 = 'abcdefghijk';
	}

	public function testMaxBelow(){
		$this->objString->string3 = 'abcdefghi';
		$this->assertEquals('abcdefghi', $this->objString->string3);
	}

	public function testJSONOutput(){
		$this->objString->string = 'hello';
		$this->objString->string2 = 'world';
		$this->objString->string3 = null;
		$this->objString->string4 = null;
		$this->objString->string5 = null;

		//string and string2 are set
		$strExpecetedJSON = '{"string":"hello","string2":"world","string4":null}';
		$strJSON = json_encode($this->objString);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objString->string = 'hello';
		$this->objString->string2 = 'world';
		$this->objString->string3 = null;
		$this->objString->string4 = null;
		$this->objString->string5 = '!';

		//string 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"string":"hello","string2":"world","string4":null}';
		$strJSON = json_encode($this->objString);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objString->string = null;
		$this->objString->string2 = null;
		$this->objString->string3 = null;
		$this->objString->string4 = null;
		$this->objString->string5 = null;

		//everything is null - only string4 shows null
		$strExpecetedJSON = '{"string4":null}';
		$strJSON = json_encode($this->objString);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}