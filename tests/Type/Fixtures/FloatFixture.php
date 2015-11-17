<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class FloatFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'float' => array('type' => 'float'),
		'float1' => array('type' => 'float'),
		'float2' => array('type' => 'float', 'default' => 15.72),
		'float3' => array('type' => 'float', 'min' => 0, 'max' => 10),
		'float4' => array('type' => 'float', 'jsonnull' => true),
		'float5' => array('type' => 'float', 'json' => false)
	);
}