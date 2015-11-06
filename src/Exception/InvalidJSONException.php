<?php
/**
*	This file contains the Invalid JSON Exception Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Invalid JSON Exception Class
*
*	Exception for attempting to decode a bad JSON string.
*
*	@package	Frozensheep\Synthesize
*
*/
class InvalidJSONException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param string $strType The object type that was requested, but is unknown.
	*	@return self
	*/
    public function __construct($strJSON){
        parent::__construct(sprintf('Invalid JSON string: %s', $strJSON));
    }
}