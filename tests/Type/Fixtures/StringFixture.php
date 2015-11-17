<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class StringFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'string' => array('type' => 'string'),
		'string1' => array('type' => 'string'),
		'string2' => array('type' => 'string', 'default' => 'hello'),
		'string3' => array('type' => 'string', 'min' => 3, 'max' => 10),
		'string4' => array('type' => 'string', 'jsonnull' => true),
		'string5' => array('type' => 'string', 'json' => false)
	);
}