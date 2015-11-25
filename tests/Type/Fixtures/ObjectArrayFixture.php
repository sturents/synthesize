<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class ObjectArrayFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'objectarray' => array('type' => 'objectarray'),
		'objectarray1' => array('type' => 'objectarray', 'class' => '\DateTime'),
		'objectarray2' => array('type' => 'objectarray', 'max' => 3),
		'objectarray3' => array('type' => 'objectarray', 'jsonnull' => true),
		'objectarray4' => array('type' => 'objectarray', 'json' => false)
	);
}