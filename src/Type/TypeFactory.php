<?php
/**
*	This file contains the Type Factory Class.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
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
*	@package	Frozensheep\Synthesize
*
*/
class TypeFactory {

	/**
	*	Create Method
	*
	*	Returns a type object based on the options given.
	*	@param Frozensheep\Synthesize\Type\SynthesizeOption $arrOptions The options
	*	return object The object for the type created.
	*/
	static public function create(SynthesizeOption $arrOptions){
		$strType = 'Frozensheep\\Synthesize\\Type\\'.$arrOptions->get('type');
		if(!class_exists($strType)){
			throw new UnknownTypeException($strType);
		}

		return new $strType();
	}
}