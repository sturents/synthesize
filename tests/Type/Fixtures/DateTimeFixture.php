<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class DateTimeFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'datetime' => array('type' => 'datetime'),
		'datetime1' => array('type' => 'datetime', 'default' => '2015-11-23'),
		'datetime2' => array('type' => 'datetime', 'jsonnull' => true),
		'datetime3' => array('type' => 'datetime', 'json' => false),
		'datetime4' => array('type' => 'datetime', 'format' => 'd/m/Y'),
		'datetime5' => array('type' => 'datetime', 'autoinit' => false)
	);
}