<?php
/**
*	This file contains the Type Factory Class.
*
*	@package		Synthesize
*	@author			Jacob Wyke <jacob@frozensheep.com>
*	@file_Version	$Rev: 1937 $
*	@Last_Change	$LastChangedDate: 2014-11-27 10:18:05 +0000 (Thu, 27 Nov 2014) $
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\SynthesizeOption;
use Frozensheep\Synthesize\Exception\UnknownTypeException;

/**
*	Type Factory Class
*
*	Class build the different synthesize types.
*
*	@package   		H2O
*	@subpackage		Synthesize
*
*/
class TypeFactory {

	/**
	*	Create
	*
	*	Returns a type object based on the options given.
	*	@param Frozensheep\Synthesize\Type\SynthesizeOption $arrOptions The options
	*	return mixed The object for the type created.
	*/
	static public function create(SynthesizeOption $arrOptions){
		$strType = 'Frozensheep\\RightmoveADF\\Synthesize\\Type\\'.$arrOptions->get('type');
		if(!class_exists($strType)){
			throw new UnknownTypeException($strType);
		}

		return new $strType();
	}
}