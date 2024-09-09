<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Tests\Type\Fixtures\IdFixture;
use PHPUnit\Framework\TestCase;

class IdTest extends TestCase {

	protected $objId;

	protected function setUp(): void{
		$this->objId = new IdFixture();
	}

	public function testNullOnCreate(){
		$this->assertEquals(null, $this->objId->id);
	}

	public function testAllowedValues(){
		$this->objId->id1 = 4;
		$this->assertEquals(4, $this->objId->id1);

		$this->objId->id1 = -4;
		$this->assertEquals(-4, $this->objId->id1);

		$this->objId->id1 = 'hello';
		$this->assertEquals('hello', $this->objId->id1);

		$this->objId->id1 = array(1,2,3);
		$this->assertEquals(array(1,2,3), $this->objId->id1);
	}

	public function testDefault(){
		$this->assertEquals('hello', $this->objId->id1);

		$this->assertEquals(15, $this->objId->id2);

		$this->assertEquals(array(1,2,3), $this->objId->id3);
	}

	public function testJSONOutput(){
		$this->objId->id = 'hello';
		$this->objId->id2 = -3;
		$this->objId->id3 = null;
		$this->objId->id4 = null;
		$this->objId->id5 = null;

		//int and int2 are set
		$strExpecetedJSON = '{"id":"hello","id1":"hello","id2":-3,"id4":null}';
		$strJSON = json_encode($this->objId);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONFalseOption(){
		$this->objId->id = 'hello';
		$this->objId->id1 = null;
		$this->objId->id2 = -3;
		$this->objId->id3 = null;
		$this->objId->id4 = null;
		$this->objId->id5 = 7;

		//int 5 shouldnt be shown as it has the option 'json==false'
		$strExpecetedJSON = '{"id":"hello","id2":-3,"id4":null}';
		$strJSON = json_encode($this->objId);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}

	public function testJSONNull(){
		$this->objId->id = null;
		$this->objId->id1 = null;
		$this->objId->id2 = null;
		$this->objId->id3 = null;
		$this->objId->id4 = null;
		$this->objId->id5 = null;

		//everything is null - only int4 shows null
		$strExpecetedJSON = '{"id4":null}';
		$strJSON = json_encode($this->objId);
		$this->assertEquals($strExpecetedJSON, $strJSON);
	}
}