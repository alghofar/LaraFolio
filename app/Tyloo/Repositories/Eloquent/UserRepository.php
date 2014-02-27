<?php namespace Tyloo\Repositories\Eloquent;

use Tyloo\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Tyloo\Services\Forms\SettingsForm;
use Tyloo\Services\Forms\RegistrationForm;
use Tyloo\Exceptions\UserNotFoundException;
use Tyloo\Repositories\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * Create a new DbUserRepository instance.
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
    public function findAllPaginated($perPage = 200)
    {
        return $this->model
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
    }

    /**
     * Find a user by it's username.
     *
     * @param  string $username
     * @return \Tyloo\User
     */
    public function findByUsername($username)
    {
        return $this->model->whereUsername($username)->first();
    }

    /**
     * Find a user by it's email.
     *
     * @param  string $email
     * @return \Tyloo\User
     */
    public function findByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
    }

    /**
     * Require a user by it's username.
     *
     * @param  string $username
     * @return \Tyloo\User
     * @throws \Tyloo\Exceptions\UserNotFoundException
     */
    public function requireByUsername($username)
    {
        if (! is_null($user = $this->findByUsername($username))) {
            return $user;
        }

        throw new UserNotFoundException('The user "' . $username . '" does not exist!');
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

        $user->email    = e($data['email']);
        $user->username = e($data['username']);
        $user->password = Hash::make($data['password']);
        $user->avatar    = isset($data['image_url']) ? $data['image_url'] : null;

        $user->save();

        return $user;
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
        $user->username = $data['username'];
        $user->password = ($data['password'] != '') ? $data['password'] : $user->password;

        if ($data['avatar'] != '') {
            File::move('img/avatar/temp/'.$data['avatar'], 'img/avatar/'.$data['avatar']);

            if ($user->avatar) {
                File::delete('img/avatar/'.$user->avatar);
            }

            $user->avatar = $data['avatar'];
        }

        return $user->save();
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
     * Get the user settings form service.
     *
     * @return \Tyloo\Services\Forms\SettingsForm
     */
    public function getSettingsForm()
    {
        return app('Tyloo\Services\Forms\SettingsForm');
    }
}
