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
class ArrayExample implements \JsonSerializable {

	//include the Sythesizer trait
	use Synthesizer;

	//set the synthesized variables
	protected $arrSynthesize = array(
		'name' => array('type' => 'string'),
		'options' => array('type' => 'dictionary'),
		'address' => array('json' => false)
	);
}

//create the object
$objExample = new ArrayExample();

//use the synthesized variables
$objExample->name = 'frozensheep';

$objExample->options = array(
	'name' => 'jacob',
	'title' => 'mr'
);

$strJSON = json_encode($objExample);
echo $strJSON.PHP_EOL;