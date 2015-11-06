<?php
/*
*
*	@package		Synthesize
*	@author			Jacob Wyke <jacob@frozensheep.com>
*	@file_Version	$Rev: 1937 $
*	@Last_Change	$LastChangedDate: 2014-11-27 10:18:05 +0000 (Thu, 27 Nov 2014) $
*
*/

namespace Frozensheep\Synthesize\Type;

use Frozensheep\Synthesize\Type\FixedDictionary;

class File extends FixedDictionary {

	protected $arrKeys = array(
		'error',
		'name',
		'size',
		'tmp_name',
		'type'
	);

	protected $arrDefaults = array(
		'error' => NULL,
		'name' => NULL,
		'size' => NULL,
		'tmp_name' => NULL,
		'type' => NULL,
	);

}