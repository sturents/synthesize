<?php
/**
*	This file contains example code for how to use the Synthesize package with an array.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

//include the composer autoloader
require_once(__DIR__.'/../vendor/autoload.php');

//use the Synthesizer
use Frozensheep\Synthesize\Synthesizer;

/**
*	ArrayExample Class
*
*	Class to show an example of how to use the Synthesize package with an array.
*
*	@package	Frozensheep\Synthesize
*
*/
class ArrayExample {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'myString' => array('type' => 'string'),
		'myBool' => array('type' => 'boolean'),
		'myDouble' => array('type' => 'double'),
		'myFloat' => array('type' => 'float'),
		'myInt' => array('type' => 'int'),
		'myNumber' => array('type' => 'number'),
		'myObject' => array('type' => 'object'),
		'myResource' => array('type' => 'resource'),
		'testing'
	);
}

//create the object
$objExample = new ArrayExample();

//use the synthesized variables
$objExample->myString = 'hello world';
echo $objExample->myString.PHP_EOL;

$objExample->myNumber = 123;
echo $objExample->myNumber.PHP_EOL;

$objExample->testing = 5.34;
echo $objExample->testing.PHP_EOL;