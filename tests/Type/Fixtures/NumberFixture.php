<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class NumberFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'num' => array('type' => 'number'),
		'num1' => array('type' => 'number'),
		'num2' => array('type' => 'number', 'default' => 15),
		'num3' => array('type' => 'number', 'min' => 0, 'max' => 10),
		'num4' => array('type' => 'number', 'jsonnull' => true),
		'num5' => array('type' => 'number', 'json' => false)
	);
}