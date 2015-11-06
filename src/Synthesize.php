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
class Synthesize {

	/**
	*	@var array $arrProperties The list of available properties that are synthesized.
	*/
	private $arrProperties = array();

	/**
	*	@var array $arrOptions Array of the synthesize options.
	*/
	private $arrOptions = array();

	/**
	*	@var array $arrData The property data.
	*/
	private $arrData = array();

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
			$this->arrPropeties[] = $strProperty;
			$this->arrOptions[$strProperty] = new SynthesizeOption($mixOptions);
			$this->arrData[$strProperty] = $this->_create($this->arrOptions[$strProperty]);
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
	*	Get Method
	*
	*	Returns the value of the property requested.
	*	@param string $strProperty The name of the value you want to get.
	*	@return mixed Whatever type the value of the property is.
	*/
	public function get($strProperty){
		$strProperty = $this->_formatPropertyName($strProperty);
		return $this->getObject($strProperty)->getValue();
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
		$this->getObject($strProperty)->setValue($mixValue);
	}

	/**
	*	Get Object Method
	*
	*	Returns the full object of the property requested.
	*	@param string $strProperty The name of the value you want to get.
	*	@return mixed Whatever type the property is.
	*/
	public function getObject($strProperty){
		$strProperty = $this->_formatPropertyName($strProperty);
		return $this->arrData[$strProperty];
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
		$this->arrData[$strProperty] = $mixValue;
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
		if(in_array($strProperty, $this->arrPropeties)){
			return true;
		}
		return false;
	}

	/**
	*	Format Property Name Method
	*
	*	Converts the property name into something valid and always the same.
	*
	*	@param string $strProperty The property to format.
	*	@return string The converted property name.
	*/
	private function _formatPropertyName($strProperty){
		return strtolower($strProperty);
	}
}