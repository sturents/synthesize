<?php
/**
*	This file contains the Missing Method Exception Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	MIssing Method Exception Class
*
*	Exception for attempting to access a method that does not exist and that cannot be dealt with through the synthesizer.
*
*	@package	Frozensheep\Synthesize
*
*/
class MissingMethodException extends \BadFunctionCallException {

	/**
	*	Constructor
	*
	*	@param string $strMethod The method that was called.
	*	@param object $objObject The object that the method was called on.
	*	@return self
	*/
    public function __construct($strMethod, $objObject){
        parent::__construct(sprintf('Attempted to call undefined method \'%s::%s\'.', get_class($objObject), $strMethod));
    }
}