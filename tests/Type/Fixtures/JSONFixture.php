<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use Frozensheep\Synthesize\Synthesizer;

class JSONFixture implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;
}