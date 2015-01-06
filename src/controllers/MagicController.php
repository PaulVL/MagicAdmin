<?php  namespace PaulVL\MagicAdmin;

use Config;
use View;
use PaulVL\MagicAdmin\MagicMessage;
use DB;
use Schema;
use PDO;
use ErrorException;

class MagicController extends BaseController {

	protected $models = array();

	public function __construct()
	{
		$this->models = $this->setMagicModels();
	}

	private function setMagicModels()
	{
		$default = Config::get('packages/paulvl/magicadmin/config.default');
		return Config::get("packages/paulvl/magicadmin/config.modes.$default");
	}

	public static function getMagicModels()
	{
		return with(new static)->models;
	}

	public static function getMagicModel($model)
	{
		try {
			return $models[$model];			
		} catch (Exception $e) {
			return null;
		}
	}

	public function create($model)
	{
		if(isset($this->models[$model])) {
			$magic_model = $this->models[$model];
			return View::make('magicadmin::admin.create')->with('model', $magic_model);
		} else {

			throw new ErrorException("MagicModel $model does not exit!, check your models have a proper name on config file!", 0, 1, '', 0);
		}
	}

	public function store()
	{
		return 'loing';
	}

	public function index()
	{
		return View::make('magicadmin::admin.index');
	}

	public function all($model)
	{
		if(isset($this->models[$model])) {
			$magic_model = $this->models[$model];
			return View::make('magicadmin::admin.all')->with('model', $magic_model);
		} else {

			throw new ErrorException("MagicModel $model does not exit!, check your models have a proper name on config file!", 0, 1, '', 0);
		}
	}

	public function save()
	{
		return MagicMessage::displayMessage('save','success');
	}

	public function update()
	{
		
	}

	public function delete()
	{
		
	}

}