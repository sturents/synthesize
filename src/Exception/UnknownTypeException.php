<?php
/**
*	This file contains the Unknown Type Exception Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Unknown Type Exception Class
*
*	Exception for attempting to create an unknown synthesize object type.
*
*	@package	Frozensheep\Synthesize
*
*/
class UnknownTypeException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param string $strType The object type that was requested, but is unknown.
	*	@return self
	*/
    public function __construct($strType){
        parent::__construct(sprintf('Unknown type of: %s', $strType));
    }
}