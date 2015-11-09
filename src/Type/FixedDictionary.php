<?php
/**
*	File containing the Fixed Dictionary class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Dictionary;

/**
*	Fixed Dictionary Class
*
*	An abstract data type for a fixed dictionaries.
*
*	@package	Frozensheep\Synthesize
*
*/
abstract class FixedDictionary extends Dictionary {

	/**
	*	@var array $arrKeys The allowed keys.
	*/
	protected $arrKeys = array();

	/**
	*	@var array $arrDefaults The default values.
	*/
	protected $arrDefaults = array();

	/**
	*	Class Constructore
	*
	*	@param array $arrDictionary The array of values for the dictionary.
	*	@return self
	*/
	public function __construct(Array $arrDictionary = array()){
		$this->replace($arrDictionary);
	}

	/**
	*	Replace Method
	*
	*	Replaces all the values in the dictionary.
	*	@param array $arrDictionary The array of values for the dictionary.
	*	@return void
	*/
	public function replace(Array $arrDictionary){
		$this->setValue(array());

		foreach($this->arrKeys as $strKey){
			if(isset($arrDictionary[$strKey])){
				$mixValue = $arrDictionary[$strKey];
			}else{
				$mixValue = $this->arrDefaults[$strKey];
			}
			parent::set($strKey, $mixValue);
		}
	}

	/**
	*	Set Method
	*
	*	Sets the value for the given key.
	*	@param string $strKey The key name.
	*	@param mixed $mixValue The value to set.
	*	@return void
	*/
	public function set($strKey, $mixValue){
		if($this->has($strKey)){
			$this->getValue()[$strKey] = $mixValue;
		}else{
			throw new \Exception();
		}
	}
}