<?php
/**
*	This file contains the Types interface.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize\Type;

/**
*	Types Interface
*
*	The Interface for all data types used in the synthesize process.
*	@package	Frozensheep\Synthesize
*
*/
interface TypesInterface {

	/**
	*	Setup Method
	*
	*	Called after the object is created by the TypeFactory to finish any setup required.
	*	@return void
	*/
	public function setup();

	/**
	*	Get Value Method
	*
	*	Returns the value for the property.
	*	@return mixed
	*/
	public function getValue();

	/**
	*	Set Value Method
	*
	*	Sets the value for the property.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function setValue($mixValue);

	/**
	*	Is Valid Method
	*
	*	Checks to see if the value is valud for the given data type.
	*	@param mixed $mixValue The value to check.
	*	@return bool
	*/
	public function isValid($mixValue);
}