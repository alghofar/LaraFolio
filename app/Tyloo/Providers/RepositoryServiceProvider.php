<?php namespace Tyloo\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;

use Tyloo\Exceptions\AdminUsersUserNotFoundException;

class RepositoryServiceProvider extends ServiceProvider
{

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		/**
		 * User Repository binding with the Interface (Eloquent)
		 */
		$this->app->bind('Tyloo\Repositories\UserRepositoryInterface', 'Tyloo\Repositories\Eloquent\UserRepository');

		/**
		 * User Mailer Services
		 */
		Event::subscribe('Tyloo\Services\Mailers\UserMailer');

		/**
		 * Throw error when trying to fetch an unexisting user
		 */
		App::error(function(AdminUsersUserNotFoundException $e) {
			return Redirect::route('admin.users.index')->withError($e->getMessage());
		});
	}

}