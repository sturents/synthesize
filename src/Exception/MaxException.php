<?php
/**
*	This file contains the Max Exception Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Exception;

/**
*	Max Exception Class
*
*	Exception for a value outside of the maxed allowed.
*
*	@package	Frozensheep\Synthesize
*
*/
class MaxException extends \RuntimeException {

	/**
	*	Constructor
	*
	*	@param mixed $mixMax The maximum value.
	*	@return self
	*/
	public function __construct($mixMax){
		parent::__construct(sprintf('The maximum number of items is "%d".', $mixMax));
	}
}