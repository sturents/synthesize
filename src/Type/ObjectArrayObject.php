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
use Frozensheep\Synthesize\Exception\MaxException;
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
	*	Setup Method
	*
	*	Overwrite the ArrayObject method as we dont allow defaults for this type.
	*	@return void
	*/
	public function setup(){

	}

	/**
	*	Is Valid Item Method
	*
	*	Checks to see if the value is valid to be stored inside the array.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function isValidItem($mixValue){
		if(is_object($mixValue)){
			if($this->options()){
				if(!is_null($this->options()->max)){
					if(count($this->mixValue)>=$this->options()->max){
						throw new MaxException($this->options()->max);
						return false;
					}
				}

				if(!is_null($this->options()->class)){
					$strClass = $this->options()->class;
					if(!$mixValue instanceof $strClass){
						throw new ClassException($mixValue, $this->options()->class);
						return false;
					}
				}
			}

			return true;
		}

		return false;
	}
}