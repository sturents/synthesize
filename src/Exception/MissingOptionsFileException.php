<?php
/**
*	This file contains the Missing Options File Exception Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Missing Options File Exception Class
*
*	Exception for attempting to access a JSON options file that doesnt exist.
*
*	@package	Frozensheep\Synthesize
*
*/
class MissingOptionsFileException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param string $strFileName The file name we could not find.
	*	@return self
	*/
    public function __construct($strFileName){
        parent::__construct(sprintf('Unable to find JSON options file \'%s\'.', $strFileName));
    }
}