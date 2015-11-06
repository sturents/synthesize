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

class String extends Type {

	/*
	*
	*	@Method:		isValid
	*	@Parameters:	1
	*	@Param-1:		mixValue - Mixed - The value tomethod name
	*	@Description:	Ensures that the value is a string
	*
	*/
	public function isValid($mixValue){
		if(is_string($mixValue)){

			return 1;
		}

		return 0;
	}
}