<?php
/**
*	This file contains the Missing Option Exception Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Missing Option Exception Class
*
*	Exception for a missing required option.
*
*	@package	Frozensheep\Synthesize
*
*/
class MissingOptionException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param string $strOption The missing option.
	*	@return self
	*/
    public function __construct($strOption){
        parent::__construct(sprintf('Missing the required option \'%s\'.', $strOption));
    }
}