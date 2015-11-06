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

use Frozensheep\Synthesize\Type\Dictionary;

abstract class FixedDictionary extends Dictionary {

	protected $arrKeys = array();
	protected $arrDefaults = array();

	/*
	*
	*	@Method:		__construct
	*	@Parameters:	1
	*	@Param-1:		arrOptions - Array - The options
	*	@Description:	Ensures that the value is an array
	*
	*/
	public function __construct(Array $arrDictionary = array()){
		$this->replace($arrDictionary);
	}

	/*
	*
	*	@Method:		replace
	*	@Parameters:	1
	*	@Param-1:		arrDictionary - Array - The dictionary values
	*	@Description:	Replaces the whole dictionary with a new one
	*
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
		if($this->has($strKey)){
			$this->getValue()[$strKey] = $mixValue;
		}else{
			throw new \Exception();
		}
	}
}