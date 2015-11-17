<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class IntFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'int' => array('type' => 'int'),
		'int1' => array('type' => 'int'),
		'int2' => array('type' => 'int', 'default' => 15),
		'int3' => array('type' => 'int', 'min' => 0, 'max' => 10),
		'int4' => array('type' => 'int', 'jsonnull' => true),
		'int5' => array('type' => 'int', 'json' => false)
	);
}