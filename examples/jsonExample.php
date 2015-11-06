<?php
/**
*	This file contains example code for how to use the Synthesize package with an JSON config file.
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
*	JSON Example Class
*
*	Class to show an example of how to use the Synthesize package with an array.
*
*	@package	Frozensheep\Synthesize
*
*/
class JSONExample {

	//include the Sythesizer trait
	use Synthesizer;
}

//create the object
$objExample = new JSONExample();

//use the synthesized variables
$objExample->myString = 'hello world';
echo $objExample->myString.PHP_EOL;