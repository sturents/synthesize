<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\ObjectFixture;
use PHPUnit\Framework\TestCase;

class ObjectTest extends TestCase {

	protected $objObject;

	protected function setUp(): void{
		$this->objObject = new ObjectFixture();
	}

	public function testNullOnCreate(){
		$this->assertEquals(null, $this->objObject->object);
	}

	public function testPossitiveInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object1 = 4;
	}

	public function testNagativeInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object1 = -4;
	}

	public function testZero(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object1 = 0;
	}

	public function testNull(){
		$this->objObject->object1 = null;
		$this->assertEquals(null, $this->objObject->object1);
	}

	public function testFloat(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object1 = 4.5;
	}

	public function testNegtiveFloat(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object1 = -4.5;
	}

	public function testString(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object1 = 'hello';
	}

	public function testStringInt(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object1 = '4';
	}

	public function testArray(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object1 = array();
	}

	public function testObject(){
		$objObject = new \DateTime();
		$this->objObject->object1 = $objObject;
		$this->assertEquals($objObject, $this->objObject->object1);

		$this->assertInstanceOf('\DateTime', $this->objObject->object1);
	}

	public function testDefault(){
		$this->assertInstanceOf('\DateTime', $this->objObject->object2);

		$this->assertNull($this->objObject->object3);
	}

	public function testClass(){
		$this->assertInstanceOf('\DateTime', $this->objObject->object6);
	}

	public function testBadClass(){
		$this->expectException('Frozensheep\Synthesize\Exception\ClassException');
		$this->objObject->object6 = new \stdClass;
	}

	public function testPassingObjectParams(){
		$this->objObject->object6 = '2015-11-25';
		$this->assertEquals(new \DateTime('2015-11-25'), $this->objObject->object6);

		$this->objObject->object6 = new \DateTime('2015-11-25');
		$this->assertEquals(new \DateTime('2015-11-25'), $this->objObject->object6);
	}

	public function testPassingBadObjectParams(){
		$this->expectException('Frozensheep\Synthesize\Exception\TypeException');
		$this->objObject->object6 = 'hello';
	}

	public function testInvalidClass(){
		$this->assertInstanceOf('\DateTime', $this->objObject->object6);
	}

	public function testAutoInit(){
		$this->assertNull($this->objObject->object7);

		$this->objObject->object7 = new \DateTime('2015-11-25');
		$this->assertEquals(new \DateTime('2015-11-25'), $this->objObject->object7);

		$this->objObject->object7 = null;
		$this->assertNull($this->objObject->object7);
	}

	public function testJSONOutput(){
		$objObject = new \DateTime();

		$this->objObject->object = null;
		$this->objObject->object2 = null;
		$this->objObject->object3 = null;
		$this->objObject->object4 = null;
		$this->objObject->object5 = null;
		$this->objObject->object6 = $objObject;

		//object4 is null and object6 is set
		$strExpecetedJSON = '{"object4":null,"object6":'.json_encode($objObject).'}';
		$strJSON = json_encode($this->objObject);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$objObject = new \DateTime();

		$this->objObject->object = null;
		$this->objObject->object2 = null;
		$this->objObject->object3 = null;
		$this->objObject->object4 = null;
		$this->objObject->object6 = $objObject;

		//object 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"object4":null,"object6":'.json_encode($objObject).'}';
		$strJSON = json_encode($this->objObject);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objObject->object = null;
		$this->objObject->object2 = null;
		$this->objObject->object3 = null;
		$this->objObject->object4 = null;
		$this->objObject->object5 = null;
		$this->objObject->object6 = null;

		//everything is null - only object4 shows null
		$strExpecetedJSON = '{"object4":null}';
		$strJSON = json_encode($this->objObject);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}