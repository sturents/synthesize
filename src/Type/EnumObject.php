<?php
/**
*	File Containing the EnumObject class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Type;
use Frozensheep\Synthesize\Exception\MissingOptionException;

/**
*	Enum Object Class
*
*	An enum data class.
*
*	@package	Frozensheep\Synthesize
*
*/
class EnumObject extends Type {

	/**
	*	Setup Method
	*
	*	Called after the object is created by the TypeFactory to finish any setup required.
	*	@return void
	*/
	public function setup(){
		if($this->hasOption('class') && $this->options()->class){
			if(($this->hasOption('autoinit') && $this->options()->autoinit) && $this->hasOption('default')){
				$this->setValue($this->options()->default);
			}
		}else{
			throw new MissingOptionException('class');
		}
	}

	/**
	*	As Value Method
	*
	*	Returns the value of the object.
	*	@return mixed
	*/
	public function asValue(){
		if(is_null($this->mixValue)){
			return null;
		}

		return $this->mixValue->getValue();
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
		if(is_null($mixValue)){
			$this->mixValue = null;
			return true;
		}

		$strClass = $this->options()->class;
		$this->mixValue = new $strClass($mixValue);
	}

	/**
	*	JSON Serialise Method
	*
	*	Method for the \JsonSerializable Interface.
	*	@return mixed
	*/
	public function jsonSerialize(){
		return $this->asValue();
	}
}