<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;
use Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture;

class EnumFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'enum' => array('type' => 'enum', 'class' => 'Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture'),
		'enum2' => array('type' => 'enum', 'class' => 'Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture', 'default' => 5),
		'enum3' => array('type' => 'enum', 'class' => 'Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture', 'default' => null),
		'enum4' => array('type' => 'enum', 'class' => 'Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture', 'jsonnull' => true),
		'enum5' => array('type' => 'enum', 'class' => 'Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture', 'json' => false),
		'enum6' => array('type' => 'enum', 'class' => 'Frozensheep\Synthesize\Tests\Type\Fixtures\MonthsFixture', 'autoinit' => false),
	);
}