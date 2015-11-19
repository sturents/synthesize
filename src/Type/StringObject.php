<?php
/**
*	File Containing the String Object class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Type;
use Frozensheep\Synthesize\Exception\LengthException;

/**
*	String Object Class
*
*	A string data class.
*
*	@package	Frozensheep\Synthesize
*
*/
class StringObject extends Type {

	/**
	*	Is Valid Method
	*
	*	Checks to see if the value is valud for the given data type.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function isValid($mixValue){
		if(is_string($mixValue)){
			if($this->options()){
				if(!is_null($this->options()->min)){
					if(mb_strlen($mixValue)<$this->options()->min){
						throw new LengthException($mixValue, $this->options()->min, $this->options()->max);
						return false;
					}
				}
				if(!is_null($this->options()->max)){
					if(mb_strlen($mixValue)>$this->options()->max){
						throw new LengthException($mixValue, $this->options()->min, $this->options()->max);
						return false;
					}
				}
			}
			return true;
		}
		return false;
	}
}