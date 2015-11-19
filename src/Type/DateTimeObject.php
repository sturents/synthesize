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
	*	Is Valid Method
	*
	*	Checks to see if the value is valud for the given data type.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function isValid($mixValue){
		if(is_object($mixDate)){
			return $mixDate;
		}else{
			return new DateTime($mixDate, new DateTimeZone($strTimezone));
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
		if((is_object($mixValue) && $mixValue instanceof \DateTime) || is_null($mixValue)){
			$this->mixValue = $mixValue;
			return true;
		}else if(is_string($mixValue)){
			$this->mixValue = new \DateTime($mixValue);
			return true;
		}
	}

	/**
	*	JSON Serialise Method
	*
	*	Method for the \JsonSerializable Interface.
	*	@return mixed
	*/
	public function jsonSerialize(){
		if($this->getValue() instanceof \DateTime){
			return $this->getValue()->format($this->options()->format);
		}
		return '';
	}
}