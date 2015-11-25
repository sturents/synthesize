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

use Frozensheep\Synthesize\Type\FixedDictionaryObject;

/**
*	Synthesize Option Class
*
*	A fixed dictionary data type to hold the synthesize options in.
*
*	@package	Frozensheep\Synthesize
*
*/
class SynthesizeOption extends FixedDictionaryObject {

	/**
	*	@var array $arrKeys The allowed keys.
	*/
	protected $arrKeys = array(
		'type',
		'default',
		'min',
		'max',
		'format',
		'class',
		'json',
		'jsonnull',
		//'readonly',
		'autoinit'
	);

	/**
	*	@var array $arrDefaults The default values.
	*/
	protected $arrDefaults = array(
		'type' => 'id',
		'default' => null,
		'min' => null,
		'max' => null,
		'format' => null,
		'class' => null,
		'json' => true,
		'jsonnull' => false,
		//'readonly' => false,
		'autoinit' => true
	);
}