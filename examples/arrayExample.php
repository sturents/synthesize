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

include('Months.php');

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
		'name' => array('type' => 'string', 'max' => 20),
		'email' => array('type' => 'string', 'max' => 20, 'default' => 'me@example.com'),
		'options' => array('type' => 'dictionary'),
		'address' => array('json' => false),
		'latitude' => array('type' => 'float', 'max' => 90.0, 'min' => -90.0),
		'type' => array('type' => 'int', 'max' => 90, 'min' => -15),
		'date' => array('type' => 'datetime', 'format' => 'd-m-Y G:i:s'),
		'object' => array('type' => 'object', 'class' => '\DateTime'),
		'object2' => array('type' => 'object', 'class' => '\DateTime', 'autoinit' => false),
		'month'  => array('type' => 'enum', 'class' => '\Months'),
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

$objExample->latitude = 35.23;

$objExample->type = 3;

$objExample->date = '2015-12-11 12:35:45';

$objExample->month = 4;

$strJSON = json_encode($objExample);
echo $strJSON.PHP_EOL;