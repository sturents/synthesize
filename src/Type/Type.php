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

use Frozensheep\Synthesize\Type\TypesInterface;
use Frozensheep\Synthesize\Exception\TypeException;

class Type implements TypesInterface {

	protected $mixValue;

	/*
	*
	*	@Method:		__construct
	*	@Parameters:	1
	*	@Param-1:		arrOptions - Array - The options
	*	@Description:	Ensures that the value is an array
	*
	*/
	public function __construct($mixValue = NULL){
		$this->setValue($mixValue);
	}

	/*
	*
	*	@Method:		getValue
	*	@Parameters:	0
	*	@Description:	returns the value
	*
	*/
	public function &getValue(){
		return $this->mixValue;
	}

	/*
	*
	*	@Method:		setValue
	*	@Parameters:	1
	*	@Param-1:		mixValue - Mixed - The value tomethod name
	*	@Description:	Sets the value
	*
	*/
	public function setValue($mixValue){
		if($this->isValid($mixValue) || is_null($mixValue)){
			$this->mixValue = $mixValue;
		}else{
			throw new TypeException($mixValue, get_class($this));
		}
	}

	/*
	*
	*	@Method:		isValid
	*	@Parameters:	1
	*	@Param-1:		mixValue - Mixed - The value tomethod name
	*	@Description:	Checks to see if the value is valid for the given class
	*
	*/
	public function isValid($mixValue){
		return 1;
	}
}