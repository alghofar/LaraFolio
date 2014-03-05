<?php namespace Tyloo\Providers;

use Illuminate\Support\ServiceProvider;
use Tyloo\Services\Navigation\Builder;

class NavigationServiceProvider extends ServiceProvider
{

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['navigation.builder'] = $this->app->share(function ($app) {
			return new Builder($app['config'], $app['auth']);
		});
	}

}