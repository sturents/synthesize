<?php
/**
*	File containing the Object Array Object class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\ArrayObject;
use Frozensheep\Synthesize\Exception\ClassException;

/**
*	Object Array Object Class
*
*	An Object Array data type class. Only allows items of the allowed class.
*
*	@package	Frozensheep\Synthesize
*
*/
class ObjectArrayObject extends ArrayObject {

	/**
	*	Offset Set Method
	*
	*	Offset Set method for the \ArrayAccess Interface.
	*	@param mixed $mixOffset The array offset/key.
	*	@param mixed $mixValue The value to set.
	*	@return void
	*/
	public function offsetSet($mixOffset, $mixValue){
		$strClass = $this->options()->class;

		if(is_object($mixValue)){
			if($mixValue instanceof $strClass){
				$this->mixValue[] = $mixValue;
				return;
			}
		}

		//fall back to putting the value into a class
		$this->mixValue[] = new $strClass($mixValue);
	}

	/**
	*	Is Valid Method
	*
	*	Checks to see if the value is value for the given data type. We only accept arrays.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function isValid($mixValue){
		if(is_object($mixValue)){
			if($this->options()->class){
				$strClass = $this->options()->class;
				if($mixValue instanceof $strClass){
					return true;
				}else{
					throw new ClassException($mixValue, $strClass);
					return false;
				}
			}

			return true;
		}else{
			return false;
		}
	}
}