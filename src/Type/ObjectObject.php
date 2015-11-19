<?php
/**
*	File Containing the Object Object class.
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
*	Object Object Class
*
*	An object data class.
*
*	@package	Frozensheep\Synthesize
*
*/
class ObjectObject extends Type {

	/**
	*	Setup Method
	*
	*	Called after the object is created by the TypeFactory to finish any setup required.
	*	@return void
	*/
	public function setup(){
		if($this->options()->autoinit && $this->options()->class){
			$strClass = $this->options()->class;
			$this->setValue(new $strClass);
		}
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

	/**
	*	JSON Serialise Method
	*
	*	Method for the \JsonSerializable Interface.
	*	@return mixed
	*/
	public function jsonSerialize(){
		return is_object($this->mixValue) ? $this->mixValue : null;
	}
}