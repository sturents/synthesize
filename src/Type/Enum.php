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
class Enum extends Type {

	/**
	*	Setup Method
	*
	*	Called after the object is created by the TypeFactory to finish any setup required.
	*	@return void
	*/
	public function setup(){

	}

	/**
	*	Get Value Method
	*
	*	Returns the value for the property.
	*	@return mixed
	*/
	public function &getValue(){
		if(is_object($this->mixValue)){
			return $this->mixValue->getValue();
		}

		return null;
	}

	/**
	*	Set Value Method
	*
	*	Sets the value for the property.
	*	@param mixed $mixValue The value to check.
	*	@throws TypeException if valud is not valid.
	*	@return bool
	*/
	public function setValue($mixValue){
		$strClass = $this->options()->class;
		$this->mixValue = new $strClass($mixValue);
	}
}