<?php
/**
*	File Containing the Boolean class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Type;

/**
*	Boolean Class
*
*	A boolean data class.
*
*	@package	Frozensheep\Synthesize
*
*/
class Boolean extends Type {

	/**
	*	Is Valid Method
	*
	*	Checks to see if the value is valud for the given data type.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function isValid($mixValue){
		if(is_bool($mixValue)){
			return true;
		}
		return false;
	}
}