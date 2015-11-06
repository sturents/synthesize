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

class TypeException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param string $strMethod The method that was called.
	*	@param object $objObject The object that the method was called on.
	*	@return self
	*/
    public function __construct($mixValue, $strExpectedType){
        parent::__construct(sprintf('Expected value of type %s, %s given', $strExpectedType, gettype(mixValue)));
    }
}