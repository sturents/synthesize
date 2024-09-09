<?php

namespace Frozensheep\Synthesize\Tests\Type\Fixtures;

use MyCLabs\Enum\Enum;

class MonthsFixture extends Enum implements \JsonSerializable {

	const January = 1;
	const February = 2;
	const March = 3;
	const April = 4;
	const May = 5;
	const June = 6;
	const July = 7;
	const August = 8;
	const September = 9;
	const October = 10;
	const November = 11;
	const December = 12;

	/**
	*	JSON Serialise Method
	*
	*	Method for the \JsonSerializable Interface.
	*	@return mixed
	*/
	#[\ReturnTypeWillChange]
	public function jsonSerialize(){
		return $this->getValue();
	}
}