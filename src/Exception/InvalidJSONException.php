<?php
/**
*	This file contains the Invalid JSON Exception Class.
*
*	@package		Synthesize
*	@author			Jacob Wyke <jacob@frozensheep.com>
*	@file_Version	$Rev: 1937 $
*	@Last_Change	$LastChangedDate: 2014-11-27 10:18:05 +0000 (Thu, 27 Nov 2014) $
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Invalid JSON Exception Class
*
*	Exception for attempting to decode a bad JSON string.
*
*	@package   		H2O
*	@subpackage		Synthesize
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