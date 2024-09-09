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
class Type implements TypesInterface, \JsonSerializable {

	/**
	*	@var mixed $mixValue The value we are storing.
	*/
	protected $mixValue;

	/**
	*	@var object $_objOptions The options set for this data type.
	*/
	private $_objOptions;

	/**
	*	To String Method
	*
	*	Returns the string form of the data type.
	*	@return string
	*/
	public function __toString(){
		return $this->jsonSerialize();
	}

	/**
	*	Method Contructor
	*
	*	@param mixed An optional value to set upon construction.
	*	@return self
	*/
	public function __construct($mixValue = null, SynthesizeOption $objOptions = null){
		if($mixValue){
			$this->setValue($mixValue);
		}
		if($objOptions){
			$this->setOptions($objOptions);
		}

		$this->setup();
	}

	/**
	*	Setup Method
	*
	*	Called after the object is created by the TypeFactory to finish any setup required.
	*	@return void
	*/
	public function setup(){
		if($this->hasOption('default', true)){
			$this->setValue($this->options()->default);
		}
	}

	/**
	*	As Value Method
	*
	*	Returns the value of the object.
	*	@return mixed
	*/
	public function asValue(){
		return $this->mixValue;
	}

	/**
	*	As Object Method
	*
	*	Returns the object.
	*	@return object
	*/
	public function asObject(){
		return $this;
	}

	/**
	*	Set Options Method
	*
	*	@param \Frozensheep\Synthesize\Type\SynthesizeOption $objOption The options about what data object is required.
	*	@return void
	*/
	public function setOptions(SynthesizeOption $objOptions){
		$this->_objOptions = $objOptions;
	}

	/**
	*	Options Method
	*
	*	Returns the SynthesizeOption object for the given property.
	*	@return Frozensheep\Synthesize\Type\SynthesizeOption
	*/
	public function options(){
		return $this->_objOptions;
	}

	/**
	*	Has Option Method
	*
	*	Checks to see if the given option is set and available.
	*	@param $strOption The option.
	*	@return boolean
	*/
	public function hasOption($strOption, $boolAllowNull = false){
		if($this->options()){
			if($boolAllowNull || !is_null($this->options()->{$strOption})){
				return true;
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
		if($this->isValid($mixValue) || is_null($mixValue)){
			$this->mixValue = $mixValue;
			return true;
		}

		throw new TypeException($mixValue, get_class($this));
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

	/**
	*	JSON Serialise Method
	*
	*	Method for the \JsonSerializable Interface.
	*	@return mixed
	*/
	#[\ReturnTypeWillChange]
	public function jsonSerialize(){
		return $this->asValue();
	}
}