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
		'array' => array('type' => 'arrayobject'),
		'array2' => array('type' => 'objectarray', 'class' => '\DateTime'),
		'features' => array('type' => 'objectarray', 'class' => 'Frozensheep\Synthesize\Type\String', 'max' => 10),
		'months' => array('type' => 'objectarray', 'class' => 'Months', 'max' => 10)
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

$objExample->array[] = 'hello';
$objExample->array[] = 'world';

$objExample->array2[] = 'now';
$objExample->array2[] = new DateTime();
try{
	$objExample->array2[] = new ArrayExample();
}catch (Exception $e){
	echo "Invalid class type".PHP_EOL;
}

$objExample->features[] = 'testing';
$objExample->features[] = 'testing2';

$objExample->months[] = 1;
$objExample->months[] = 4;
$objExample->months[] = 8;


$strJSON = json_encode($objExample);
echo $strJSON.PHP_EOL;