<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class ArrayFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'array' => array('type' => 'array'),
		'array1' => array('type' => 'array', 'default' => array(1,2,3,4,5)),
		'array2' => array('type' => 'array', 'max' => 3),
		'array3' => array('type' => 'array', 'jsonnull' => true),
		'array4' => array('type' => 'array', 'json' => false)
	);
}