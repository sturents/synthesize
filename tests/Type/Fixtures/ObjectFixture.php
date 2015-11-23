<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class ObjectFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'object' => array('type' => 'object'),
		'object1' => array('type' => 'object'),
		'object2' => array('type' => 'object', 'default' => '\DateTime'),
		'object3' => array('type' => 'object', 'default' => null),
		'object4' => array('type' => 'object', 'jsonnull' => true),
		'object5' => array('type' => 'object', 'class' => '\DateTime', 'json' => false),
		'object6' => array('type' => 'object', 'class' => '\DateTime'),
		'object7' => array('type' => 'object', 'class' => '\DateTime', 'autoinit' => false),
	);
}