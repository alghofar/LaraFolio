<?php namespace Tyloo\Services;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Tyloo\Repositories\UserRepositoryInterface;

/**
* User Register
*/
class AuthEvents
{

    /**
     * User Repository.
     *
     * @var \Tyloo\Repositories\UserRepositoryInterface
     */
    protected $users;

    protected $errors;

    /**
     * Create a new AuthController instance.
     *
     * @param  \Tyloo\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users)
    {

        $this->users = $users;
    }

    public function register()
    {
        // We populate the form
        $form = $this->users->getRegistrationForm();

        // If the entry is not valid, we redirect back with the errors
        if ( ! $form->isValid()) {
            $this->errors = ['errors' => $form->getErrors()];

            return false;
        }

        // We create the user
        else if ($user = $this->users->create($form->getInputData())) {
            Event::fire('user.mailer.register', [
                'user_id' => $user['id'],
                'email' => $user['email'],
                'token' => $user['activation_code']
            ]);

            return true;
        }

        $this->errors = ['errors' => 'An error occured on the user creation process.'];

        return false;
    }

    public function create()
    {
        // We populate the form
        $form = $this->users->getAdminUsersCreateForm();

        // If the entry is not valid, we redirect back with the errors
        if ( ! $form->isValid()) {
            $this->errors = ['errors' => $form->getErrors()];

            return false;
        }

        // We create the user
        else if ($user = $this->users->save($form->getData())) {
            Event::fire('user.mailer.create', [
                'user_id' => $user['id'],
                'email' => $user['email'],
                'password' => $form->getInputData()['password'],
                'token' => $user['activation_code']
            ]);

            return true;
        }

        $this->errors = ['errors' => 'An error occured on the user creation process.'];

        return false;
    }

    public function update($id)
    {
        // We populate the form
        $form = $this->users->getAdminUsersUpdateForm();

        // If the entry is not valid, we redirect back with the errors
        if ( ! $form->isValid()) {
            $this->errors = ['errors' => $form->getErrors()];

            return false;
        }

        // We update the user
        $user = $this->users->findById($id);
        $user->save($form->getData());

        return true;
    }

    public function login()
    {
        // We populate the form
        $form = $this->users->getLoginForm();

        // If the entry is not valid, we redirect back with the errors
        if ( ! $form->isValid()) {
            $this->errors = ['error' => '<h5>E-mail or password was incorrect, please try again</h5>'];

            return false;
        }

        // We log the user in
        $login_attempt = $this->users->checkValidForLogin($form->getInputData());
        if ($login_attempt !== false) {
            $this->errors = $login_attempt;

            return false;
        }

        return true;
    }

    public function logout()
    {
        $this->users->logout();
    }

    public function activate($user_id, $token)
    {
        $user = $this->users->findById($user_id);
        if ($user->activated) {
            $this->errors = ['error' => '<p>You have already activated your account. Please log in with your credentials.'];

            return false;
        } elseif ($user->activation_code != $token) {
            $this->errors = ['error' => '<p>The activation you provided doesn\'t match with our database.'];

            return false;
        }
        $this->users->activate($user);
        Auth::loginUsingId($user_id);

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

}
