<?php

namespace Frozensheep\Synthesize\Tests\Type;

use Frozensheep\Synthesize\Type\SynthesizeOption;
use Frozensheep\Synthesize\Type\TypeFactory;
use Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture;
use PHPUnit\Framework\TestCase;

class TypeFactoryTest extends TestCase {

	public static function synthesizerOptionProvider(){
		return array(
			"arrayObject" => array(
				array('type' => 'arrayObject'),
				'Frozensheep\Synthesize\Type\ArrayObject'
			),
			"boolean" => array(
				array('type' => 'boolean'),
				'Frozensheep\Synthesize\Type\BooleanObject'
			),
			"dateTime" => array(
				array('type' => 'dateTime'),
				'Frozensheep\Synthesize\Type\DateTimeObject'
			),
			"dictionary" => array(
				array('type' => 'dictionary'),
				'Frozensheep\Synthesize\Type\DictionaryObject'
			),
			"enum" => array(
				array('type' => 'enum', 'class' => 'Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture'),
				'Frozensheep\Synthesize\Type\EnumObject'
			),
			"float" => array(
				array('type' => 'float'),
				'Frozensheep\Synthesize\Type\FloatObject'
			),
			"id" => array(
				array('type' => 'id'),
				'Frozensheep\Synthesize\Type\IdObject'
			),
			"int" => array(
				array('type' => 'int'),
				'Frozensheep\Synthesize\Type\IntObject'
			),
			"number" => array(
				array('type' => 'number'),
				'Frozensheep\Synthesize\Type\NumberObject'
			),
			"object" => array(
				array('type' => 'object'),
				'Frozensheep\Synthesize\Type\ObjectObject'
			),
			"objectArray" => array(
				array('type' => 'objectArray'),
				'Frozensheep\Synthesize\Type\ObjectArrayObject'
			),
			"resource" => array(
				array('type' => 'resource'),
				'Frozensheep\Synthesize\Type\ResourceObject'
			),
			"string" => array(
				array('type' => 'string'),
				'Frozensheep\Synthesize\Type\StringObject'
			),
			"default" => array(
				array(),
				'Frozensheep\Synthesize\Type\IdObject'
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

		$this->expectException('Frozensheep\Synthesize\Exception\UnknownTypeException');
		$objType = TypeFactory::create($objSynthesizeOptions);
	}
}