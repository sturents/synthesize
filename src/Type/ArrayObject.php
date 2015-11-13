<?php
/**
*	File containing the Type Array class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Type;

/**
*	Array Class
*
*	An array data type class. Only allows items of the allowed type.
*
*	@package	Frozensheep\Synthesize
*
*/
class ArrayObject extends Type implements \Iterator, \ArrayAccess, \Countable {

	/**
	*	@var mixed $mixValue The value we are storing. Always an array in this type.
	*/
	protected $mixValue = array();

	/**
	*	@var int $_numPosition The current pointer position for Iteration.
	*/
	private $_numPosition = 0;

	/**
	*	Setup Method
	*
	*	Called after the object is created by the TypeFactory to finish any setup required.
	*	@return void
	*/
	public function setup(){
		$this->mixValue = array();
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
		return $this->mixValue[$this->_numPosition];
	}

	/**
	*	Key Method
	*
	*	Key method for the Iterator Interface.
	*	@return
	*/
	function key(){
		return $this->_numPosition;
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
		return isset($this->mixValue[$this->_numPosition]);
	}

	/**
	*	Offset Set Method
	*
	*	Offset Set method for the \ArrayAccess Interface.
	*	@param mixed $mixOffset The array offset/key.
	*	@param mixed $mixValue The value to set.
	*	@return void
	*/
	public function offsetSet($mixOffset, $mixValue){
		if($this->isValid($mixValue)){
			if(is_null($mixOffset)){
				$this->mixValue[] = $mixValue;
			}else{
				$this->mixValue[$mixOffset] = $mixValue;
			}
		}
	}

	/**
	*	Offset Exists Method
	*
	*	Offset Exists method for the \ArrayAccess Interface.
	*	@param mixed $mixOffset The array offset/key.
	*	@return boolean
	*/
	public function offsetExists($mixOffset){
		return isset($this->mixValue[$mixOffset]);
	}

	/**
	*	Offset Unset Method
	*
	*	Offset Unset method for the \ArrayAccess Interface.
	*	@param mixed $mixOffset The array offset/key.
	*	@return void
	*/
	public function offsetUnset($mixOffset){
		unset($this->mixValue[$mixOffset]);
	}

	/**
	*	Offset Exists Method
	*
	*	Offset Exists method for the \ArrayAccess Interface.
	*	@param mixed $mixOffset The array offset/key.
	*	@return boolean
	*/
	public function offsetGet($mixOffset){
		return isset($this->mixValue[$mixOffset]) ? $this->mixValue[$mixOffset] : null;
	}

	/**
	*	JSON Serialise Method
	*
	*	Method for the \JsonSerializable Interface.
	*	@return mixed
	*/
	public function jsonSerialize(){
		$arrData = array();

		foreach($this->mixValue as $mixItem){
			print_r($mixItem);
			$arrData[] = $mixItem;
		}

		return count($arrData) ? $arrData : null;
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