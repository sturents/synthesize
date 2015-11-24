<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\DateTimeObjectFixture;

class DateTimeObjectTest extends \PHPUnit_Framework_TestCase {

	protected $objDateTime;

	protected function setUp(){
		$this->objDateTime = new DateTimeObjectFixture();
	}

	public function testDateTimeOnCreate(){
		$objToday = new \DateTime();

		$this->assertEquals($objToday->format('Y-m-d'), $this->objDateTime->datetime->format('Y-m-d'));
	}

	public function testPossitiveInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objDateTime->datetime = 4;
	}

	public function testNagativeInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objDateTime->datetime = -4;
	}

	public function testZero(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objDateTime->datetime = 0;
	}

	public function testNull(){
		$this->objDateTime->datetime = null;
		$this->assertNull($this->objDateTime->datetime);
	}

	public function testFloat(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objDateTime->datetime = 4.5;
	}

	public function testNegtiveFloat(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objDateTime->datetime = -4.5;
	}

	public function testString(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objDateTime->datetime = 'hello';
	}

	public function testDateString(){
		$this->objDateTime->datetime = '2015-11-23';
		$this->assertEquals('2015-11-23', $this->objDateTime->datetime->format('Y-m-d'));
	}

	public function testStringInt(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objDateTime->datetime1 = '4';
	}

	public function testArray(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objDateTime->datetime1 = array();
	}

	public function testObject(){
		$objObject = new \DateTime();
		$this->objDateTime->datetime = $objObject;
		$this->assertEquals($objObject, $this->objDateTime->datetime);
		$this->assertInstanceOf('\DateTime', $this->objDateTime->datetime);
	}

	public function testDefault(){
		$this->assertEquals('2015-11-23', $this->objDateTime->datetime1->format('Y-m-d'));
	}

	public function testClass(){
		$this->assertInstanceOf('\DateTime', $this->objDateTime->datetime);
	}

	public function testInvalidClass(){
		$this->setExpectedException('Frozensheep\Synthesize\Exception\ClassException');
		$this->objDateTime->datetime = new \stdClass;
	}

	public function testAutoInit(){
		$this->assertNull($this->objDateTime->datetime5);
	}

	public function testJSONOutput(){
		$objObject = new \DateTime();

		$this->objDateTime->datetime4 = $objObject;

		//datetime2 is null and datetime4 is set with a format for output 'd/m/Y'
		$strExpecetedJSON = '{"datetime2":null,"datetime4":'.json_encode($objObject->format('d/m/Y')).'}';
		$strJSON = json_encode($this->objDateTime);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$objObject = new \DateTime();

		$this->objDateTime->datetime = null;
		$this->objDateTime->datetime2 = null;
		$this->objDateTime->datetime3 = $objObject;
		$this->objDateTime->datetime4 = null;

		//datetime 3 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"datetime2":null}';
		$strJSON = json_encode($this->objDateTime);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objDateTime->datetime = null;
		$this->objDateTime->datetime2 = null;
		$this->objDateTime->datetime3 = null;
		$this->objDateTime->datetime4 = null;
		$this->objDateTime->datetime5 = null;

		//everything is null - only datetime2 shows null
		$strExpecetedJSON = '{"datetime2":null}';
		$strJSON = json_encode($this->objDateTime);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}