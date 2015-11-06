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

use Frozensheep\Synthesize\Type\Dictionary;

class ServerCollection extends Dictionary {

	/*
	*
	*	@Method:		headers
	*	@Parameters:	0
	*	@Description:	Returns an array of headers
	*
	*/
	public function headers(){
		$arrHeaders = array();
		foreach($this->all() as $strKey => $strValue){
			if(substr($strKey, 0, 5) == 'HTTP_') {
				$arrHeaders[substr($strKey, 5)] = $strValue;
			}
		}

		return new HeaderCollection($arrHeaders);
	}

}