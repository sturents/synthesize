<?php
/**
*	File Containing the DateTime Object class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Type;
use Frozensheep\Synthesize\Exception\TypeException;
use Frozensheep\Synthesize\Exception\ClassException;

/**
*	DateTime Object Class
*
*	A DateTime data class.
*
*	@package	Frozensheep\Synthesize
*
*/
class DateTimeObject extends Type {

	/**
	*	Setup Method
	*
	*	Called after the object is created by the TypeFactory to finish any setup required.
	*	@return void
	*/
	public function setup(){
		if($this->hasOption('autoinit') && $this->options()->autoinit){
			if($this->hasOption('default')){
				$this->setValue($this->options()->default);
			}else{
				$this->setValue('now');
			}
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
			if($mixValue instanceof \DateTime){
				return true;
			}else{
				throw new ClassException($mixValue, '\DateTime');
				return false;
			}
		}

		if(is_string($mixValue)){
			try{
				$objTest = new \DateTime($mixValue);
				return true;
			}catch (\Exception $e){
				throw new TypeException($mixValue, get_class($this));
			}
		}

		return false;
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
		if($this->isValid($mixValue)){
			if((is_object($mixValue) && $mixValue instanceof \DateTime) || is_null($mixValue)){
				$this->mixValue = $mixValue;
				return true;
			}else if(is_string($mixValue)){
				$this->mixValue = new \DateTime($mixValue);
				return true;
			}
		}
		throw new TypeException($mixValue, get_class($this));
	}

	/**
	*	JSON Serialise Method
	*
	*	Method for the \JsonSerializable Interface.
	*	@return mixed
	*/
	public function jsonSerialize(){
		if($this->asValue() instanceof \DateTime){
			if($this->hasOption('format')){
				return $this->asValue()->format($this->options()->format);
			}else{
				if($this->hasOption('jsonnull') && $this->options()->jsonnull){
					return null;
				}
			}
		}

		if($this->hasOption('jsonnull') && $this->options()->jsonnull){
			return null;
		}
	}
}