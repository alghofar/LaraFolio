<?php namespace Tyloo\Repositories\Eloquent;

use Tyloo\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Tyloo\Repositories\UserRepositoryInterface;
use Tyloo\Exceptions\AdminUsersUserNotFoundException;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

	/**
	 * Create a new UserRepository instance.
	 *
	 * @param  \Tyloo\User  $user
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->model = $user;
	}

	/**
	 * Find all users paginated.
	 *
	 * @param  int  $perPage
	 * @return Illuminate\Database\Eloquent\Collection|\Tyloo\User[]
	 */
	public function findAllPaginated($perPage = 25)
	{
		return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
	}

	/**
	 * Find a user by its id.
	 *
	 * @param  string $id
	 * @return \Tyloo\User
	 */
	public function findById($id)
	{
		if (! is_null($user = $this->model->find($id)))
			return $user;

		throw new AdminUsersUserNotFoundException('<p>The user with id of "' . $id . '" does not exist!<p>');
	}

	/**
	 * Find a user by its username.
	 *
	 * @param  string $username
	 * @return \Tyloo\User
	 */
	public function findByUsername($username)
	{
		return $this->model->whereUsername($username)->first();
	}

	/**
	 * Find a user by its email.
	 *
	 * @param  string $email
	 * @return \Tyloo\User
	 */
	public function findByEmail($email)
	{
		return $this->model->whereEmail($email)->first();
	}

	/**
	 * Find a user by its username or its email.
	 *
	 * @param  string $user
	 * @return \Tyloo\User
	 */
	public function findByEmailOrUsername($user)
	{
		return $this->model->where('username', '=', $user)->orWhere('email', '=', $user)->first();
	}

	public function checkValidForLogin($credentials) {
		// Is the user suspended?
		$user = $this->findByEmailOrUsername($credentials['username']);
		if (! empty($credentials['username']) && $user != null) {
			if ($user->suspended == true) {
				return ['error' => '<p>Impossible to log you in, cupcake! Your account has been suspended.</p>'];
			}
			else if ($user->activated == false) {
				return ['error' => '<p>Impossible to log you in, cupcake! Your account has not been activated, yet.</p>'];
			}
		}

		// Login by Email if we detect an '@'
		if (str_contains($credentials['username'], '@')) {
			$credentials['email'] = $credentials['username'];
			unset($credentials['username']);
		}

		$remember = 0;
		// Remember the user?
		if (!empty ($credentials['remember'])) {
			$remember = 1;
			unset($credentials['remember']);
		}

		// Let's authenticate this user
		if (Auth::attempt($credentials, $remember)) {
			return false;
		}

		return ['error' => '<h5>E-mail or password was incorrect, please try again</h5>'];
	}

	/**
	 * Create a new user in the database.
	 *
	 * @param  array $data
	 * @return \Tyloo\User
	 */
	public function create(array $data)
	{
		$user = $this->getNew();

		$user->email			= e($data['email']);
		$user->username			= e($data['username']);
		$user->password			= Hash::make($data['password']);
		$user->activation_code	= str_random(32);

		$user->save();

		return $user;
	}

	/**
	 * Create a new user in the database.
	 *
	 * @param  array $data
	 * @return \Tyloo\User
	 */
	public function createByAdmin(array $data)
	{
		$user = $this->getNew();

		$user->email			= e($data['email']);
		$user->username			= e($data['username']);
		$user->password			= Hash::make($data['password']);
		$user->first_name		= e($data['first_name']);
		$user->last_name		= e($data['last_name']);
		$user->location			= e($data['location']);
		$user->description		= e($data['description']);
		$user->activation_code	= str_random(32);
		$user->is_admin			= $data['is_admin'];

		$user->save();

		return $user;
	}

	/**
	 * Create a new user in the database.
	 *
	 * @param  array $data
	 * @return \Tyloo\User
	 */
	public function updateByAdmin(User $user, array $data)
	{
		$user->username			= e($data['username']);
		$user->password			= Hash::make($data['password']);
		$user->first_name		= e($data['first_name']);
		$user->last_name		= e($data['last_name']);
		$user->location			= e($data['location']);
		$user->description		= e($data['description']);
		$user->is_admin			= $data['is_admin'];

		$user->save();
	}

	/**
	 * Returns whether the given username is allowed to be used.
	 *
	 * @param  string  $username
	 * @return bool
	 */
	protected function usernameIsAllowed($username)
	{
		return ! in_array(strtolower($username), Config::get('config.forbidden_usernames'));
	}

	/**
	 * Update the user's settings.
	 *
	 * @param  \Tyloo\User $user
	 * @param  array $data
	 * @return \Tyloo\User
	 */
	public function updateSettings(User $user, array $data)
	{
		$user->username	= $data['username'];
		$user->password	= ($data['password'] != '') ? $data['password'] : $user->password;

		return $user->save();
	}

	/**
	 * Update the user's profile.
	 *
	 * @param  \Tyloo\User $user
	 * @param  array $data
	 * @return \Tyloo\User
	 */
	public function updateProfile(User $user, array $data)
	{
		$user->first_name	= $data['first_name'];
		$user->last_name	= $data['last_name'];
		$user->location		= $data['location'];
		$user->description	= $data['description'];

		return $user->save();
	}

	/**
	 * Update the user's profile.
	 *
	 * @param  \Tyloo\User $user
	 * @return \Tyloo\User
	 */
	public function activate(User $user)
	{
		$user->activated	= 1;

		return $user->save();
	}

	/**
	 * Suspend the user.
	 *
	 * @param  \Tyloo\User $user
	 * @return \Tyloo\User
	 */
	public function suspend(User $user)
	{
		$user->suspended = 1;

		return $user->save();
	}

	/**
	 * Restore the user.
	 *
	 * @param  \Tyloo\User $user
	 * @return \Tyloo\User
	 */
	public function restore(User $user)
	{
		$user->suspended = 0;

		return $user->save();
	}

	/**
	 * Delete the user.
	 *
	 * @param  \Tyloo\User $user
	 * @return \Tyloo\User
	 */
	public function delete(User $user)
	{
		$user->delete();
	}

	/**
	 * Log the user out.
	 *
	 * @return \Tyloo\User
	 */
	public function logout()
	{
		Auth::logout();
	}

	/**
	 * Get the user registration form service.
	 *
	 * @return \Tyloo\Services\Forms\RegistrationForm
	 */
	public function getRegistrationForm()
	{
		return app('Tyloo\Services\Forms\RegistrationForm');
	}

	/**
	 * Get the user login form service.
	 *
	 * @return \Tyloo\Services\Forms\LoginForm
	 */
	public function getLoginForm()
	{
		return app('Tyloo\Services\Forms\LoginForm');
	}

	/**
	 * Get the user settings form service.
	 *
	 * @return \Tyloo\Services\Forms\SettingsForm
	 */
	public function getSettingsForm()
	{
		return app('Tyloo\Services\Forms\SettingsForm');
	}

	/**
	 * Get the user profile form service.
	 *
	 * @return \Tyloo\Services\Forms\ProfileForm
	 */
	public function getProfileForm()
	{
		return app('Tyloo\Services\Forms\ProfileForm');
	}

	/**
	 * Get the user creation by admin form service.
	 *
	 * @return \Tyloo\Services\Forms\Admin\AdminUsersCreateForm
	 */
	public function getAdminUsersCreateForm()
	{
		return app('Tyloo\Services\Forms\Admin\AdminUsersCreateForm');
	}

	/**
	 * Get the user update by admin form service.
	 *
	 * @return \Tyloo\Services\Forms\Admin\AdminUsersUpdateForm
	 */
	public function getAdminUsersUpdateForm()
	{
		return app('Tyloo\Services\Forms\Admin\AdminUsersUpdateForm');
	}

}