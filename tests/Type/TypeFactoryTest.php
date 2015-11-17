<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Type\SynthesizeOption;
use Frozensheep\Synthesize\Type\TypeFactory;

class TypeFactoryTest extends \PHPUnit_Framework_TestCase {

	public function synthesizerOptionProvider(){
		return array(
			"arrayObject" => array(
				array('type' => 'arrayObject'),
				'Frozensheep\Synthesize\Type\ArrayObject'
			),
			"boolean" => array(
				array('type' => 'boolean'),
				'Frozensheep\Synthesize\Type\Boolean'
			),
			"dateTime" => array(
				array('type' => 'dateTime'),
				'Frozensheep\Synthesize\Type\DateTime'
			),
			"dictionary" => array(
				array('type' => 'dictionary'),
				'Frozensheep\Synthesize\Type\Dictionary'
			),
			"enum" => array(
				array('type' => 'enum'),
				'Frozensheep\Synthesize\Type\Enum'
			),
			"float" => array(
				array('type' => 'float'),
				'Frozensheep\Synthesize\Type\Float'
			),
			"id" => array(
				array('type' => 'id'),
				'Frozensheep\Synthesize\Type\Id'
			),
			"int" => array(
				array('type' => 'int'),
				'Frozensheep\Synthesize\Type\Int'
			),
			"number" => array(
				array('type' => 'number'),
				'Frozensheep\Synthesize\Type\Number'
			),
			"object" => array(
				array('type' => 'object'),
				'Frozensheep\Synthesize\Type\Object'
			),
			"objectArray" => array(
				array('type' => 'objectArray'),
				'Frozensheep\Synthesize\Type\ObjectArray'
			),
			"resource" => array(
				array('type' => 'resource'),
				'Frozensheep\Synthesize\Type\Resource'
			),
			"string" => array(
				array('type' => 'string'),
				'Frozensheep\Synthesize\Type\String'
			)
		);
	}

	/**
	*	@dataProvider	synthesizerOptionProvider
	*/
	public function testCreateObjects($mixOptions, $strExpectedInstance){
		$objSynthesizeOptions = new SynthesizeOption($mixOptions);

		$objType = TypeFactory::create($objSynthesizeOptions);
		$this->assertInstanceOf($strExpectedInstance, $objType);
	}

	public function testCreateFakeType(){
		$objSynthesizeOptions = new SynthesizeOption(array('type' => 'fake'));

		$this->setExpectedException('Frozensheep\Synthesize\Exception\UnknownTypeException');
		$objType = TypeFactory::create($objSynthesizeOptions);
	}
}