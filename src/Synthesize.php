<?php
/**
*	This file contains the Synthesize Class.
*
*	@package		Synthesize
*	@author			Jacob Wyke <jacob@frozensheep.com>
*	@file_Version	$Rev: 1937 $
*	@Last_Change	$LastChangedDate: 2014-11-27 10:18:05 +0000 (Thu, 27 Nov 2014) $
*
*/

namespace Frozensheep\RightmoveADF\Synthesize;

use Frozensheep\Synthesize\Type\SynthesizeOption;
use Frozensheep\Synthesize\Type\TypeFactory;
use Frozensheep\Synthesize\Exception\InvalidJSONException;

/**
*	Synthesize Class
*
*	Class to hold all the synthesized data.
*
*	@package		Frozensheep\RightmoveADF\Synthesize
*
*/
class Synthesize {

	private $arrPropeties = array();
	private $arrOptions = array();
	private $arrData = array();

	/**
	*	Class Constructor
	*
	*	Class constructure with the option to setup the properties direct or else you need to call a create method after.
	*	@param mixed $mixData The optional synthesize options in the form of an array.
	8	@todo Add in additional options for sythensize config to be a file or object - maybe json etc.
	*	@return self
	*/
	public function __construct($mixData = null){
		if($mixData !== null){
			$this->setup($mixData);
		}
	}

	/**
	*	Setup
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
	*	Setup With Array
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

			$strProperty = $this->formatPropertyName($strProperty);
			$this->arrPropeties[] = $strProperty;
			$this->arrOptions[$strProperty] = new SynthesizeOption($mixOptions);
			$this->arrData[$strProperty] = $this->_create($this->arrOptions[$strProperty]);
		}
	}

	/**
	*	Setup With JSON
	*
	*	Sets up the object using a stringof JSON.
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
	*	Get
	*
	*	Returns the value of the property requested.
	*	@param string $strProperty The name of the value you want to get.
	*	@return mixed Whatever type the value of the property is.
	*/
	public function get($strProperty){
		$strProperty = $this->formatPropertyName($strProperty);
		return $this->getObject($strProperty)->getValue();
	}

	/**
	*	Set
	*
	*	Sets a properties value
	*	@param string $strProperty The property name.
	*	@param mixed $mixValue The value to set.
	*	@return void
	*/
	public function set($strProperty, $mixValue){
		$strProperty = $this->formatPropertyName($strProperty);
		$this->getObject($strProperty)->setValue($mixValue);
	}

	/**
	*	Get Object
	*
	*	Returns the full object of the property requested.
	*	@param string $strProperty The name of the value you want to get.
	*	@return mixed Whatever type the property is.
	*/
	public function getObject($strProperty){
		$strProperty = $this->formatPropertyName($strProperty);
		return $this->arrData[$strProperty];
	}

	/**
	*	Set Object
	*
	*	Sets an object for the property.
	*	@param string $strProperty The property name.
	*	@param mixed $mixValue The value to set.
	*	@return void
	*/
	public function setObject($strProperty, $mixValue){
		$strProperty = $this->formatPropertyName($strProperty);
		$this->arrData[$strProperty] = $mixValue;
	}

	/**
	*	Create data object.
	*
	*	Used internally to create the object used to store the data type.
	*	@param \Frozensheep\Synthesize\Type\SynthesizeOption $objOption The options about what data object is required.
	*
	*/
	private function _create(SynthesizeOption $objOption){
		return TypeFactory::create($objOption);
	}

	/**
	*	Has Property?
	*
	*	Checks to see if a given property is set.
	*	@param string $strProperty The property you want to check.
	*	@return true|false
	*/
	public function hasProperty($strProperty){
		$strProperty = $this->formatPropertyName($strProperty);
		if(in_array($strProperty, $this->arrPropeties)){
			return true;
		}
		return false;
	}

	/**
	*	Format Property Name
	*
	*	Converts the property name into something valid and always the same.
	*
	*	@param string $strProperty The property to format.
	*	@return string The converted property name.
	*/
	static public function formatPropertyName($strProperty){
		return strtolower($strProperty);
	}
}