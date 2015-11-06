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
*	Type Exception Class
*
*	Exception for providing the wrong data type to a property.
*
*	@package	Frozensheep\Synthesize
*
*/
class TypeException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param mixed $mixValue The value that was attempted to be set.
	*	@param string $strExpectedType The expected type.
	*	@return self
	*/
    public function __construct($mixValue, $strExpectedType){
        parent::__construct(sprintf('Expected value of type %s, %s given', $strExpectedType, gettype(mixValue)));
    }
}