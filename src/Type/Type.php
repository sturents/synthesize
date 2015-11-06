<?php
/**
*	File containing the Type class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\TypesInterface;
use Frozensheep\Synthesize\Exception\TypeException;

/**
*	Type Class
*
*	The type class whic provides the most fundamental methods needed for all data types and acts as the parent class for many sub-data types.
*
*	@package	Frozensheep\Synthesize
*
*/
class Type implements TypesInterface {

	/**
	*	@var mixed $mixValue The value we are storing.
	*/
	protected $mixValue;

	/**
	*	Class Contructor
	*
	*	@param mixed $mixValue An optional value to set on construction.
	*	@return self
	*/
	public function __construct($mixValue = null){
		$this->setValue($mixValue);
	}

	/**
	*	Get Value Method
	*
	*	Returns the value for the property.
	*	@return mixed
	*/
	public function &getValue(){
		return $this->mixValue;
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
		if($this->isValid($mixValue) || is_null($mixValue)){
			$this->mixValue = $mixValue;
			return true;
		}else{
			throw new TypeException($mixValue, get_class($this));
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
		return true;
	}
}