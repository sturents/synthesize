<?php
/**
*	This file contains the Synthesizer Trait.
*
*	@package	Frozensheep\Synthesize
*	@author		Jacob Wyke <jacob@frozensheep.com>
*	@license	MIT
*
*/

namespace Frozensheep\Synthesize;

use Frozensheep\Synthesize\Synthesize;
use Frozensheep\Synthesize\Exception\MissingMethodException;
use Frozensheep\Synthesize\Exception\SynthesizeException;
use Frozensheep\Synthesize\Exception\MissingOptionsFileException;

/**
*	Synthesizer Trait
*
*	The trait to control the synthesizer functionality.
*
*	This provides getter/setter methods automatically to any setup properties.
*	To setup the synthesize properties use the following class var:
*
*	protected $arrSynthesize = array(
*		'get' => array('type' => 'Dictionary'),
*		'post' => array('type' => 'Dictionary'),
*		'cookie' => array('type' => 'Dictionary'),
*		'server' => array('type' => 'ServerCollection'),
*		'files' => array('type' => 'Dictionary')
*	);
*
*	@package	Frozensheep\Synthesize
*
*/
trait Synthesizer {

	/**
	* @var Synthesize $_objSynthesize Object containing the synthesize object for this class.
	*/
	private $_objSynthesize = null;

	/**
	* @var mixed $_mixSynthesizeOptions Contains the synthesize options.
	*/
	private $_mixSynthesizeOptions;

	/**
	*	__Call Magic Method
	*
	*	Controls all unknown method calls for the class and attempts to answer them by using our synthesize options.
	*	@param string $strName The name of the method called.
	*	@param array $arrArguments The array of arguments passed to the method call.
	*	@todo Look at allowing multiple arguments to be passed when setting - could be useful for array data types or something.
	*	@return mixed
	*/
    public function __call($strName, Array $arrArguments){
		if(method_exists($this, $strName)){
        	return $this->$strName(implode(', ', $arrArguments));
        }else{
			//check to see if there's a synthesize property for this
			if($this->getSynthesize()->hasProperty($strName)){
				if(isset($arrArguments[0])){
					//set request
					return $this->getSynthesize()->set($strName, $arrArguments[0]);
				}else{
					//get request
					return $this->getSynthesize()->get($strName);
				}
			}else{
				throw new MissingMethodException($strName, $this);
			}
        }
    }

	/**
	*	__get Magic Method
	*
	*	Handles out synthesize code to return the variable requested.
	*	@param string $strProperty The requested property name.
	*	@throws SynthesizeException if there is no property with that name.
	*	@return mixed
	*/
    public function __get($strProperty){
		if($this->getSynthesize()->hasProperty($strProperty)){
			return $this->getSynthesize()->get($strProperty);
		}else{
			throw new SynthesizeException($strProperty, $this);
		}
    }

	/**
	*	__set Magic Method
	*
	*	Handles setting values.
	*	@param string $strProperty The property name.
	*	@param mixed $mixValue The value to set.
	*	@throws SynthesizeException if there is no property with that name.
	*	@return null
	*/
    public function __set($strProperty, $mixValue){
		if($this->getSynthesize()->hasProperty($strProperty)){
			return $this->getSynthesize()->set($strProperty, $mixValue);
		}else{
			throw new SynthesizeException($strProperty, $this);
		}
    }

	/**
	*	To String Magic Method
	*
	*	Returns the string form of the data type.
	*	@return string
	*/
	public function __toString(){
		return json_encode($this->jsonSerialize());
	}

	/**
	*	Get Synthesize Method
	*
	*	Sets up and returns the synthesize object.
	*	@return \Frozensheep\Synthesize
	*/
    public function getSynthesize(){
		if(!$this->_objSynthesize instanceof Synthesize){
			$this->_objSynthesize = $this->_createSynthesize();
		}

		return $this->_objSynthesize;
    }

	/**
	*	Create Synthesize Method
	*
	*	Factory to create the a synthesize object. Currently only accepts synthesize options in array format.
	*	@param mixed $mixSynthesize The synthesize options. If none are passed it checks for build options from the calling class.
	*	@return \Frozensheep\Synthesize
	*/
    private function _createSynthesize($mixSynthesize = null){
		//override the values set in the class with the ones passed
		if($mixSynthesize){
			$this->_mixSynthesizeOptions = $mixSynthesize;
		}else{
			if(!empty($this->arrSynthesize)){
				//array settings override all others
				$this->_mixSynthesizeOptions = $this->arrSynthesize;
			}else if(isset($this->mixSynthesize)){
				$this->_mixSynthesizeOptions = $this->mixSynthesize;
			}else{
				//fall back to gettin settings from JSON file with same name as class
				$this->_mixSynthesizeOptions = $this->_loadOptionsFromFile(get_class());
			}
		}

		//create the object
		return new Synthesize($this->_mixSynthesizeOptions);
    }

	/**
	*	Load Options From File Method
	*
	*	Attempts to load the synthesize options from the JSON file passed.
	*	@param string $strFileName The name of the JSON file where the options are.
	*	@return \Frozensheep\Synthesize
	*/
    private function _loadOptionsFromFile($strFileName){
    	//get the path for the class file and name and add the .json extension to the file name
    	$objReflector = new \ReflectionClass($this);
    	$strFileName = dirname($objReflector->getFileName()).'/'.$strFileName.'.json';

    	if(file_exists($strFileName)){
			return file_get_contents($strFileName);
    	}else{
			throw new MissingOptionsFileException($strFileName);
    	}
    }

	/**
	*	JSON Serialise Method
	*
	*	Called by json_* methods so we can control what items are returned.
	*	@return mixed
	*/
	public function jsonSerialize(){
		return $this->getSynthesize()->jsonSerialize();
	}
}