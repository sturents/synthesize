<?php
/**
*	This file contains the Unknown Type Exception Class.
*
*	@package		Synthesize
*	@author			Jacob Wyke <jacob@frozensheep.com>
*	@file_Version	$Rev: 1937 $
*	@Last_Change	$LastChangedDate: 2014-11-27 10:18:05 +0000 (Thu, 27 Nov 2014) $
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Unknown Type Exception Class
*
*	Exception for attempting to create an unknown synthesize object type.
*
*	@package   		H2O
*	@subpackage		Synthesize
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