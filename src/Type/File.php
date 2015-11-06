<?php
/**
*	File containing the File Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\FixedDictionary;

/**
*	File Class
*
*	A File data type for uploaded files.
*
*	@package	Frozensheep\Synthesize
*
*/
class File extends FixedDictionary {

	/**
	*	@var array $arrKeys The allowed keys.
	*/
	protected $arrKeys = array(
		'error',
		'name',
		'size',
		'tmp_name',
		'type'
	);

	/**
	*	@var array $arrDefaults The default values.
	*/
	protected $arrDefaults = array(
		'error' => null,
		'name' => null,
		'size' => null,
		'tmp_name' => null,
		'type' => null,
	);
}