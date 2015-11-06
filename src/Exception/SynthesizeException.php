<?php
/**
*	This file contains the Synthesize Exception Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Synthesize Exception Class
*
*	Exception for attempting to access a synthesize propety that is not set.
*
*	@package	Frozensheep\Synthesize
*
*/
class SynthesizeException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param string $strProperty The property that was called.
	*	@param object $objObject The object it was called on.
	*	@return self
	*/
    public function __construct($strProperty, $objObject){
        parent::__construct(sprintf('Synthesize not setup for \'%s\' in \'%s\'.', $strProperty, get_class($objObject)));
    }
}