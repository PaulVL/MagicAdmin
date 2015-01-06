<?php namespace PaulVL\MagicAdmin;

use Illuminate\Support\ServiceProvider;
use Config;

class MagicAdminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('paulvl/magicadmin');
		new MagicAdmin();
		if(Config::get('packages/paulvl/magicadmin/config.enabled')){
			include __DIR__.'/../../routes.php';
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['magicadmin'] = $this->app->share(function($app)
		{
			return new MagicAdmin;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}

