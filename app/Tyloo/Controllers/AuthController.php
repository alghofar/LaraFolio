<?php namespace Tyloo\Controllers;

use Tyloo\Services\AuthEvents;

class AuthController extends BaseController
{
    /**
     * User Repository.
     *
     * @var \Tyloo\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Auth Events
     * @var \Tyloo\Services\AuthEvents
     */
    protected $authEvent;

    /**
     * Create a new AuthController instance.
     *
     * @param  \Tyloo\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(AuthEvents $authEvent)
    {
        parent::__construct();

        $this->authEvent = $authEvent;
    }

    /**
     * Show registration form.
     *
     * @return \Response
     */
    public function register()
    {
        return $this->view('auth.register');
    }

    /**
     * Post registration form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister()
    {
        if ( ! $this->authEvent->register()) {
            return $this->redirectRouteInput('auth.register', $this->authEvent->errors());
        }

        return $this->redirectRoute('home', ['success' => '<h4>Welcome to LaraFolio!</h4><p>To complete your registration, enter the code from the email we just sent you!</p>']);
    }

    /**
     * Show login form.
     *
     * @return \Response
     */
    public function login()
    {
        return $this->view('auth.login');
    }

    /**
     * Post login form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        if ( ! $this->authEvent->login()) {
            return $this->redirectRouteInput('auth.login', $this->authEvent->errors());
        }

        return $this->redirectIntended('/', ['success' => '<p>You were successfully logged in! Enjoy the trip!</p>']);
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->authEvent->logout();

        return $this->redirectRoute('auth.login', ['info' => '<p>You were successfully logged out! See you soon!</p>']);
    }

    /**
     * Activate the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($user_id, $token)
    {
        if ( ! $this->authEvent->activate($user_id, $token)) {
            return $this->redirectRouteInput('auth.login', $this->authEvent->errors());
        }

        return $this->redirectRoute('home', ['success' => '<p>Your account has been successfully activated!</p>']);
    }

}
