<?php
/**
*	File containing the Dictionary class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Type;

/**
*	Dicationary Class
*
*	A Dictionary data type class.
*
*	@package	Frozensheep\Synthesize
*
*/
class Dictionary extends Type implements \Iterator, \Countable {

	/**
	*	@var array $_arrKeys The dictionary keys.
	*/
	private $_arrKeys = array();

	/**
	*	@var int $_numPosition The current pointer position for Iteration.
	*/
	private $_numPosition = 0;

	/**
	*	__get Magic Method
	*
	*	Handles quick access to properties in the dictionary.
	*	@param string $strProperty The requested property name.
	*	@return mixed
	*/
    public function __get($strProperty){
		return $this->get($strProperty);
    }

	/**
	*	__set Magic Method
	*
	*	Handles setting values.
	*	@param string $strProperty The property name.
	*	@param mixed $mixValue The value to set.
	*	@return null
	*/
    public function __set($strProperty, $mixValue){
		$this->set($strProperty, $mixValue);
    }

	/**
	*	To String Method
	*
	*	Returns the string form of the data type.
	*	@return string
	*/
	public function __toString(){
		return '';
	}

	/**
	*	Get Value Method
	*
	*	Return the object rather than the value.
	*	@return mixed
	*/
	public function &getValue(){
		return $this;
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
			$this->updateKeys();
			return true;
		}else{
			throw new TypeException($mixValue, get_class($this));
		}
	}

	/**
	*	Is Valid Method
	*
	*	Checks to see if the value is value for the given data type. We only accept arrays.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function isValid($mixValue){
		if(is_array($mixValue)){
			return true;
		}else{
			return false;
		}
	}

	/**
	*	All Method
	*
	*	Returns the dictionary array
	*	@return array
	*/
	public function all(){
		return $this->mixValue;
	}

	/**
	*	Keys Method
	*
	*	Returns all the keys of the dictionary.
	*	@return array
	*/
	public function keys(){
		return $this->_arrKeys;
	}

	/**
	*	Replace Method
	*
	*	Replaces the whole dictionary with a new one.
	*	@param array $arrDicationary The new dicationary.
	*	@return void
	*/
	public function replace(Array $arrDicationary){
		$this->setValue($arrDicationary);
		$this->updateKeys();
	}

	/**
	*	Get Method
	*
	*	Reurns the value for the given key.
	*	@param string $strKey The name of the key.
	*	@return mixed
	*/
	public function get($strKey){
		if($this->has($strKey)){
			return $this->mixValue[$strKey];
		}

		throw new \Exception();
	}

	/**
	*	Set Method
	*
	*	Sets the value for the given key.
	*	@param string $strKey The name of the key.
	*	@param mixed $mixValue The value to set.
	*	@return void
	*/
	public function set($strKey, $mixValue){
		$this->mixValue[$strKey] = $mixValue;
		$this->updateKeys();
	}

	/**
	*	Update Keys Method
	*
	*	Updates the keys to match the data we have stored.
	*	@return void
	*/
	protected function updateKeys(){
		if(is_array($this->mixValue)){
			$this->_arrKeys = array_keys($this->mixValue);
		}else{
			$this->_arrKeys = array();
		}
	}

	/**
	*	Has Method
	*
	*	Method to see if the dictionary has a key for the given value.
	*	@param string $strKey The name of the key to check.
	*	@return boolean
	*/
	public function has($strKey){
		return in_array($strKey, $this->_arrKeys);
	}

	public function contains(){

	}

	public function remove(){

	}

	/**
	*	Rewind Method
	*
	*	Rewind method for the Iterator Interface.
	*	@return void
	*/
	function rewind(){
		$this->_numPosition = 0;
	}

	/**
	*	Current Method
	*
	*	Current method for the Iterator Interface.
	*	@return mixed
	*/
	function current(){
		return $this->get($this->_arrKeys[$this->_numPosition]);
	}

	/**
	*	Key Method
	*
	*	Key method for the Iterator Interface.
	*	@return
	*/
	function key(){
		return $this->_arrKeys[$this->_numPosition];
	}

	/**
	*	Next Method
	*
	*	Next method for the Iterator Interface.
	*	@return void
	*/
	function next(){
		++$this->_numPosition;
	}

	/**
	*	Valid Method
	*
	*	Valid method for the Iterator Interface.
	*	@return boolean
	*/
	function valid(){
		return isset($this->_arrKeys[$this->_numPosition]);
	}

	/**
	*	JSON Serialise Method
	*
	*	Method for the \JsonSerializable Interface.
	*	@return mixed
	*/
	public function jsonSerialize(){
		$arrData = array();
		$this->updateKeys();
print_r($this->_arrKeys);
print_r($this->mixValue);
		foreach($this as $strKey => $mixValue){
		echo $strKey.PHP_EOL;
			$arrData[$strKey] = $mixValue;
		}
		return $arrData;
	}

	/**
	*	Count Method
	*
	*	Count method for the \Countable Interface.
	*	@return int
	*/
	public function count(){
		return count($this->mixValue);
	}
}