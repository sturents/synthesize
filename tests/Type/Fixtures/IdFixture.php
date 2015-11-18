<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class IdFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'id' => array('type' => 'id'),
		'id1' => array('default' => 'hello'),
		'id2' => array('type' => 'id', 'default' => 15),
		'id3' => array('type' => 'id', 'default' => array(1,2,3)),
		'id4' => array('type' => 'id', 'jsonnull' => true),
		'id5' => array('type' => 'id', 'json' => false)
	);
}