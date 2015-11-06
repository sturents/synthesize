<?php
/**
*	This file contains the Synthesize Exception Class.
*
*	@package		Synthesize
*	@author			Jacob Wyke <jacob@frozensheep.com>
*	@file_Version	$Rev: 1937 $
*	@Last_Change	$LastChangedDate: 2014-11-27 10:18:05 +0000 (Thu, 27 Nov 2014) $
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Synthesize Exception Class
*
*	Exception for attempting to access a synthesize propety that is not set.
*
*	@package   		H2O
*	@subpackage		Synthesize
*
*/
class SynthesizeException extends \RuntimeException {

	/*
	*
	*	@Method:		__constructor
	*	@Parameters:	2
	*	@Param-1:		strMethod - String - The method
	*	@Param-2:		objObject - Object - The object
	*	@Description:	Class Constructor
	*
	*/
    public function __construct($strProperty, $objObject){
        parent::__construct(sprintf('Synthesize not setup for \'%s\' in \'%s\'.', $strProperty, get_class($objObject)));
    }
}