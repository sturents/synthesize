<?php
/**
*	File Containing the Object class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Type;
use Frozensheep\Synthesize\Exception\ClassException;

/**
*	Object Class
*
*	An object data class.
*
*	@package	Frozensheep\Synthesize
*
*/
class Object extends Type {

	/**
	*	Class Contructor
	*
	*	@param mixed $mixValue An optional value to set on construction.
	*	@return self
	*/
	public function __construct($mixValue = null){
		if(is_null($mixValue)){
			if($this->options()->class){
				$strClass = $this->options()->class;
				$mixValue = new $strClass;
			}
		}

		$this->setValue($mixValue);
	}

	/**
	*	Is Valid Method
	*
	*	Checks to see if the value is valud for the given data type.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function isValid($mixValue){
		if(is_null($mixValue)){
			return true;
		}

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
		}
		return false;
	}
}