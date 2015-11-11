<?php
/**
*	This file contains the Class Exception Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Class Exception Class
*
*	Exception for an issue with an incorrect class.
*
*	@package	Frozensheep\Synthesize
*
*/
class ClassException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param object $objClass The object that you passed.
	*	@param string $strExpected The expected class type.
	*	@return self
	*/
	public function __construct($objClass, $strExpected){
		parent::__construct(sprintf('Incorrect class type "%s", expected "%s"', get_class($objClass), $strExpected));
	}
}