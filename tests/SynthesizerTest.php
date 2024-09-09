<?php

namespace Frozensheep\Synthesize\Tests;

use Frozensheep\Synthesize\Tests\Type\Fixtures\IdFixture;
use Frozensheep\Synthesize\Tests\Type\Fixtures\JSONFixture;
use PHPUnit\Framework\TestCase;

class SynthesizerTest extends TestCase {

	protected $objSynthesize;
	protected $objJSONSynthesize;

	protected function setUp(): void{
		$this->objSynthesize = new IdFixture();
		$this->objJSONSynthesize = new JSONFixture();
	}

	public function testPropertyGet(){
		$this->assertNull($this->objSynthesize->Id);
		$this->assertEquals('hello', $this->objSynthesize->Id1);

		$this->objSynthesize->Id = 'hello';
		$this->assertEquals('hello', $this->objSynthesize->Id);

		$this->objSynthesize->Id = '';
		$this->assertEquals('', $this->objSynthesize->Id);
		$this->assertNotNull($this->objSynthesize->Id);
	}

	public function testBadPropertyGet(){
		$this->expectException('Frozensheep\Synthesize\Exception\SynthesizeException');
		$this->objSynthesize->BadId;
	}

	public function testPropertySet(){
		$this->objSynthesize->Id = 'hello';
		$this->assertEquals('hello', $this->objSynthesize->Id);

		$this->objSynthesize->Id = 'hello2';
		$this->assertEquals('hello2', $this->objSynthesize->Id);

		$this->objSynthesize->Id = 57;
		$this->assertEquals(57, $this->objSynthesize->Id);
	}

	public function testMethodGet(){
		$this->assertInstanceOf('Frozensheep\Synthesize\Type\IdObject', $this->objSynthesize->Id());
	}

	public function testBadMethodGet(){
		$this->expectException('Frozensheep\Synthesize\Exception\MissingMethodException');
		$this->objSynthesize->BadId();
	}

	public function testMethodCall(){
		$this->assertTrue($this->objJSONSynthesize->test());
	}

	public function testBadMethodCall(){
		$this->expectException('Frozensheep\Synthesize\Exception\MissingMethodException');
		$this->objSynthesize->doesntExist();
	}

	public function testMethodSet(){
		$this->objSynthesize->Id('hello');
		$this->assertEquals('hello', $this->objSynthesize->Id);

		$this->objSynthesize->Id('hello2');
		$this->assertEquals('hello2', $this->objSynthesize->Id);

		$this->objSynthesize->Id(57);
		$this->assertEquals(57, $this->objSynthesize->Id);
	}

	public function testToString(){
		$this->assertEquals(json_encode($this->objSynthesize), $this->objSynthesize->__toString());
		$this->assertEquals('{"id1":"hello","id2":15,"id3":[1,2,3],"id4":null}', $this->objSynthesize->__toString());
		$this->assertEquals('{"id1":"hello","id2":15,"id3":[1,2,3],"id4":null}', $this->objSynthesize);
	}

	public function testGetSynthesize(){
		$this->assertInstanceOf('Frozensheep\Synthesize\Synthesize', $this->objSynthesize->getSynthesize());
		$objSynthesize = $this->objSynthesize->getSynthesize();
		$this->assertInstanceOf('Frozensheep\Synthesize\Synthesize', $this->objSynthesize->getSynthesize());
		$this->assertEquals($objSynthesize, $this->objSynthesize->getSynthesize());
	}

	public function testCreateSynthesize(){
		$this->assertInstanceOf('Frozensheep\Synthesize\Synthesize', $this->objSynthesize->_createSynthesize());

		$this->markTestIncomplete("Test with different synthesize options passed.");
	}

	public function testJSONLoad(){
		$strFile = __DIR__.'/Type/Fixtures/JSONFixture.json';
		$strJSON = $this->objJSONSynthesize->_loadOptionsFromFile('JSONFixture');
		$this->assertJsonStringEqualsJsonFile($strFile, $strJSON);
	}

	public function testJSONLoadFailure(){
		$this->expectException('Frozensheep\Synthesize\Exception\MissingOptionsFileException');
		$this->objSynthesize->_loadOptionsFromFile('doesnt_exist.json');
	}

	public function testJSON(){
		$this->assertEquals(json_encode($this->objSynthesize), json_encode($this->objSynthesize->jsonSerialize()));
		$this->assertEquals(array('id1'=>'hello','id2'=>15,'id3'=>array(1,2,3),'id4'=>null), $this->objSynthesize->jsonSerialize());
		$this->assertEquals('{"id1":"hello","id2":15,"id3":[1,2,3],"id4":null}', json_encode($this->objSynthesize));
	}
}