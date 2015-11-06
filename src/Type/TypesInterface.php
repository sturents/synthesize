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

interface TypesInterface {

	/*
	*
	*	@Method:		getValue
	*	@Parameters:	0
	*	@Description:	returns the value
	*
	*/
	public function getValue();

	/*
	*
	*	@Method:		setValue
	*	@Parameters:	1
	*	@Param-1:		mixValue - Mixed - The value tomethod name
	*	@Description:	Sets the value
	*
	*/
	public function setValue($mixValue);

	/*
	*
	*	@Method:		isValid
	*	@Parameters:	1
	*	@Param-1:		mixValue - Mixed - The value tomethod name
	*	@Description:	Checks to see if the value is valid for the given class
	*
	*/
	public function isValid($mixValue);
}