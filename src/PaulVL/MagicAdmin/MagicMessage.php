<?php  namespace PaulVL\MagicAdmin;

use Lang;

class MagicMessage {

	static $actions = array('save','update','delete','reference');
	static $results = array('success','error','warning');

	public static function displayMessage($action, $result)
	{
		if(in_array($action, self::$actions) && in_array($result, self::$results))
		{
			return Lang::get('magicadmin::messages.'.$result.'_'.$action);
		}
		return Lang::get('magicadmin::messages.generic');
	}

}