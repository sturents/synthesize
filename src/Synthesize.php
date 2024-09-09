<?php
/**
*	This file contains the Synthesize Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize;

use Frozensheep\Synthesize\Type\SynthesizeOption;
use Frozensheep\Synthesize\Type\TypeFactory;
use Frozensheep\Synthesize\Exception\InvalidJSONException;

/**
*	Synthesize Class
*
*	Class to hold all the synthesized data.
*
*	@package	Frozensheep\Synthesize
*
*/
class Synthesize implements \Iterator, \JsonSerializable {

	/**
	*	@var array $_arrProperties The list of available properties that are synthesized.
	*/
	private $_arrProperties = array();

	/**
	*	@var array $_arrOptions Array of the synthesize options.
	*/
	private $_arrOptions = array();

	/**
	*	@var array $_arrData The property data.
	*/
	private $_arrData = array();

	/**
	*	@var int $_numPosition The current pointer position for Iteration.
	*/
	private $_numPosition = 0;

	/**
	*	Class Constructor
	*
	*	Class constructure with the option to setup the properties direct or else you need to call a create method after.
	*	@param mixed $mixData The optional synthesize options in the form of an array.
	*	@todo Add in additional options for sythensize config to be a file or object - maybe json etc.
	*	@return self
	*/
	public function __construct($mixData = null){
		if($mixData !== null){
			$this->setup($mixData);
		}
	}

	/**
	*	Setup Method
	*
	*	Sets up the object with the options passed. First works out what type of options where passed.
	*	@param mixes $mixData The options
	*	@return void
	*/
	public function setup($mixData){
		if(is_array($mixData)){
			return $this->setupWithArray($mixData);
		}

		//fallback assumes JSON
		$this->setupWithJSON($mixData);
	}

	/**
	*	Setup With Array Method
	*
	*	Sets up the object using an array of options.
	*	@param array $arrData The options in array format.
	*	@return void
	*/
	public function setupWithArray(Array $arrData){
		foreach($arrData as $strProperty => $mixOptions){
			if(!is_array($mixOptions)){
				$strProperty = $mixOptions;
				$mixOptions = array();
			}

			$strProperty = $this->_formatPropertyName($strProperty);
			$this->_arrProperties[] = $strProperty;
			$this->_arrOptions[$strProperty] = new SynthesizeOption($mixOptions);
			$this->_arrData[$strProperty] = $this->_create($this->_arrOptions[$strProperty]);
		}
	}

	/**
	*	Setup With JSON Method
	*
	*	Sets up the object using a string of JSON.
	*	@param string $strData The options in JSON.
	*	@return void
	*/
	public function setupWithJSON($strData){
		if($arrData = json_decode($strData, true)){
			$this->setupWithArray($arrData);
		}else{
			throw new InvalidJSONException($strData);
		}
	}

	/**
	*	As Value Method
	*
	*	Returns the value of the property requested.
	*	@param string $strProperty The name of the value you want to get.
	*	@return mixed Whatever type the value of the property is.
	*/
	public function asValue($strProperty){
		return $this->asObject($strProperty)->asValue();
	}

	/**
	*	As Object Method
	*
	*	Returns the full object of the property requested.
	*	@param string $strProperty The name of the value you want to get.
	*	@return object
	*/
	public function asObject($strProperty){
		$strProperty = $this->_formatPropertyName($strProperty);
		return $this->_arrData[$strProperty]->asObject();
	}

	/**
	*	Set Method
	*
	*	Sets a properties value.
	*	@param string $strProperty The property name.
	*	@param mixed $mixValue The value to set.
	*	@return void
	*/
	public function set($strProperty, $mixValue){
		$strProperty = $this->_formatPropertyName($strProperty);
		$this->asObject($strProperty)->setValue($mixValue);
	}

	/**
	*	Set Object Method
	*
	*	Sets an object for the property.
	*	@param string $strProperty The property name.
	*	@param mixed $mixValue The value to set.
	*	@return void
	*/
	public function setObject($strProperty, $mixValue){
		$strProperty = $this->_formatPropertyName($strProperty);
		$this->_arrData[$strProperty] = $mixValue;
	}

	/**
	*	Create Method
	*
	*	Used internally to create the object used to store the data type.
	*	@param \Frozensheep\Synthesize\Type\SynthesizeOption $objOption The options about what data object is required.
	*	@return object
	*
	*/
	private function _create(SynthesizeOption $objOption){
		return TypeFactory::create($objOption);
	}

	/**
	*	Has Property Method
	*
	*	Checks to see if a given property is set.
	*	@param string $strProperty The property you want to check.
	*	@return true|false
	*/
	public function hasProperty($strProperty){
		$strProperty = $this->_formatPropertyName($strProperty);
		if(in_array($strProperty, $this->_arrProperties)){
			return true;
		}
		return false;
	}

	/**
	*	Options Method
	*
	*	Returns the SynthesizeOption object for the given property.
	*	@param string $strProperty The property you want the options for.
	*	@return Frozensheep\Synthesize\Type\SynthesizeOption|false
	*/
	public function &options($strProperty){
		$strProperty = $this->_formatPropertyName($strProperty);
		if($this->hasProperty($strProperty)){
			if(array_key_exists($strProperty, $this->_arrOptions)){
				return $this->_arrOptions[$strProperty];
			}
		}
		return false;
	}

	/**
	*	Format Property Name Method
	*
	*	Converts the property name into something valid and always the same.
	*	@param string $strProperty The property to format.
	*	@return string The converted property name.
	*/
	private function _formatPropertyName($strProperty){
		return strtolower($strProperty);
	}

	/**
	*	Rewind Method
	*
	*	Rewind method for the Iterator Interface.
	*	@return void
	*/
	#[\ReturnTypeWillChange]
	function rewind(){
		$this->_numPosition = 0;
	}

	/**
	*	Current Method
	*
	*	Current method for the Iterator Interface.
	*	@return mixed
	*/
	#[\ReturnTypeWillChange]
	function current(){
		return $this->_arrData[$this->_arrProperties[$this->_numPosition]];
	}

	/**
	*	Key Method
	*
	*	Key method for the Iterator Interface.
	*	@return
	*/
	#[\ReturnTypeWillChange]
	function key(){
		return $this->_arrProperties[$this->_numPosition];
	}

	/**
	*	Next Method
	*
	*	Next method for the Iterator Interface.
	*	@return void
	*/
	#[\ReturnTypeWillChange]
	function next(){
		++$this->_numPosition;
	}

	/**
	*	Valid Method
	*
	*	Valid method for the Iterator Interface.
	*	@return boolean
	*/
	#[\ReturnTypeWillChange]
	function valid(){
		return isset($this->_arrProperties[$this->_numPosition]);
	}

	/**
	*	JSON Serialise Method
	*
	*	Called by json_* methods so we can control what items are returned.
	*	@return mixed
	*/
	#[\ReturnTypeWillChange]
	public function jsonSerialize(){
		$arrData = array();

		foreach($this as $strKey => $objValue){
			if($this->options($strKey)->json){
				$mixValue = $objValue->jsonSerialize();
				$mixJSON = json_encode($mixValue);
				if((!is_null($mixValue) && $mixJSON!='[]') || $this->options($strKey)->jsonnull){
					$arrData[$strKey] = $mixValue;
				}
			}
		}
		return $arrData;
	}
}