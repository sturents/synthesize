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
	*	@param Frozensheep\Synthesize\Type\SynthesizeOption $objOptions The options object.
	*	return object The object for the type created.
	*/
	static public function create(SynthesizeOption $objOptions){
		$strType = TypeFactory::getType($objOptions->type);
		if(!class_exists($strType)){
			throw new UnknownTypeException($strType);
		}

		$objObject = new $strType(null, $objOptions);
		return $objObject;
	}

	/**
	*	Get Type Method
	*
	*	Returns a type object based on the options given.
	*	@param string $strType The name of the type.
	*	return string
	*/
	static public function getType($strType){
		//convert reserved names to the actual objects
		$arrReservere = array(
			'bool' => 'BooleanObject',
			'boolean' => 'BooleanObject',
			'datetime' => 'DateTimeObject',
			'dictionary' => 'DictionaryObject',
			'enum' => 'EnumObject',
			'id' => 'IdObject',
			'int' => 'IntObject',
			'float' => 'FloatObject',
			'string' => 'StringObject',
			'resource' => 'ResourceObject',
			'object' => 'ObjectObject',
			'objectarray' => 'ObjectArrayObject',
			'number' => 'NumberObject',
			'numeric' => 'NumberObject',
			'fixeddictionary' => 'FixedDictionaryObject'
		);

		if(array_key_exists(strtolower($strType), $arrReservere)){
			$strType = $arrReservere[strtolower($strType)];
		}

		$strType = 'Frozensheep\\Synthesize\\Type\\'.ucfirst($strType);

		return $strType;
	}
}