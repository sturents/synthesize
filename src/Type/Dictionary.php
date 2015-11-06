<?php
/*
*
*	@package		Synthesize
*	@author			Jacob Wyke <jacob@frozensheep.com>
*	@file_Version	$Rev: 1937 $
*	@Last_Change	$LastChangedDate: 2014-11-27 10:18:05 +0000 (Thu, 27 Nov 2014) $
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\Type;

class Dictionary extends Type {

	/*
	*
	*	@Method:		getValue
	*	@Parameters:	0
	*	@Description:	Return the object rather than the value
	*
	*/
	public function &getValue(){
		return $this;
	}

	/*
	*
	*	@Method:		isValid
	*	@Parameters:	1
	*	@Param-1:		mixValue - Mixed - The value tomethod name
	*	@Description:	Ensures that the value is an array
	*
	*/
	public function isValid($mixValue){
		if(is_array($mixValue)){

			return 1;
		}else{

			return 0;
		}
	}

	/*
	*
	*	@Method:		all
	*	@Parameters:	0
	*	@Description:	Returns the dictionary array
	*
	*/
	public function all(){

		return $this->mixValue;;
	}

	/*
	*
	*	@Method:		keys
	*	@Parameters:	0
	*	@Description:	Returns the keys of the dictionary
	*
	*/
	public function keys(){

		return array_keys($this->getValue());
	}

	/*
	*
	*	@Method:		replace
	*	@Parameters:	1
	*	@Param-1:		arrValues - Array - The dictionary values
	*	@Description:	Replaces the whole dictionary with a new one
	*
	*/
	public function replace(Array $arrValues){
		$this->setValue($arrValues);
	}

	/*
	*
	*	@Method:		get
	*	@Parameters:	1
	*	@Param-1:		strKey - String - The value to get
	*	@Description:	Returns the dictionary value for the key
	*
	*/
	public function get($strKey){
		if($this->has($strKey)){
			return $this->mixValue[$strKey];
		}

		throw new \Exception();
	}

	/*
	*
	*	@Method:		set
	*	@Parameters:	2
	*	@Param-1:		strKey - String - The key
	*	@Param-2:		mixValue - Mixed - The value to set
	*	@Description:	Sets the value for a key
	*
	*/
	public function set($strKey, $mixValue){
		$this->mixValue[$strKey] = $mixValue;
	}

	/*
	*
	*	@Method:		has
	*	@Parameters:	1
	*	@Param-1:		strKey - String - The value to get
	*	@Description:	Returns boolean of if this dictionary has the key
	*
	*/
	public function has($strKey){

		return array_key_exists($strKey, $this->mixValue);
	}

	public function contains(){

	}

	public function remove(){

	}

}