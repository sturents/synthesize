<?php
/**
*	File containing the Synthesize Option Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\FixedDictionary;

/**
*	Synthesize Option Class
*
*	A fixed dictionary data type to hold the synthesize options in.
*
*	@package	Frozensheep\Synthesize
*
*/
class SynthesizeOption extends FixedDictionary {

	/**
	*	@var array $arrKeys The allowed keys.
	*/
	protected $arrKeys = array(
		'type',
		'default'
	);

	/**
	*	@var array $arrDefaults The default values.
	*/
	protected $arrDefaults = array(
		'type' => 'Id',
		'default' => ''
	);
}