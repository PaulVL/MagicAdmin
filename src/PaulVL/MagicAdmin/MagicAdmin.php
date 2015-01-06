<?php  namespace PaulVL\MagicAdmin;

use Config;

class MagicAdmin {
	public static $routeBase = 'magic-admin';
	public static $date_format = 'Y-m-d H:i';
	public static $magic_model_list = 'nope';
	private $base;

	public function __construct()
	{		
		self::setRouteBase();
		self::setDateFormat();
		self::setMagicModelList();
	}

	public static function setRouteBase()
	{
		$base = trim(Config::get('packages/paulvl/magicadmin/config.route-base'));

		if(!empty($base))
		{
			self::$routeBase = $base;
		}
	}

	public static function setDateFormat()
	{
		$df = trim(Config::get('packages/paulvl/magicadmin/config.date_format'));

		if(!empty($df))
		{
			self::$date_format = $df;
		}
	}

	public static function setMagicModelList()
	{
		self::$magic_model_list = scandir(__DIR__.'/../../../../../../app/models');
		unset(self::$magic_model_list[array_search('.', self::$magic_model_list)]);
		unset(self::$magic_model_list[array_search('..', self::$magic_model_list)]);

		foreach(self::$magic_model_list as $element)
		{
			$element_wp = substr($element, 0, -4);
			if(is_subclass_of($element_wp, 'MagicModel'))
			{
				self::$magic_model_list[array_search($element, self::$magic_model_list)] = $element_wp;
			}
			else
			{
				unset(self::$magic_model_list[array_search($element, self::$magic_model_list)]);
			}
		}
	}

	public static function getMagicModelByTableName($table_name)
	{
		$magicmodel = null;

		foreach (self::$magic_model_list as $magic_model)
		{
			if($magic_model::getTableName() == $table_name)
			{
				$magicmodel = $magic_model;
				break;
			}
		}
		return $magicmodel;
	}
}