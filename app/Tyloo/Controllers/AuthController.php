<?php namespace Tyloo\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Tyloo\Repositories\UserRepositoryInterface;

class AuthController extends BaseController {

	/**
     * User Repository.
     *
     * @var \Tyloo\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new AuthController instance.
     *
     * @param  \Tyloo\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users)
    {
        parent::__construct();

        $this->users = $users;
    }


    /**
     * Show registration form.
     *
     * @return \Response
     */
    public function getRegister()
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
        // We populate the form
        $form = $this->users->getRegistrationForm();

        // If the entry is not valid, we redirect back with the errors
        if ( ! $form->isValid()) {
            return $this->redirectRouteInput('auth.getRegister', [], ['errors' => $form->getErrors()]);
        }

        // We create the user
        if ($user = $this->users->create($form->getInputData())) {
            Auth::login($user);

            return $this->redirectRoute('home', [], ['success' => '<h4>Welcome to LaraFolio!</h4><p>Get into the awesomeness!</p>']);
        }

        return $this->redirectRoute('home');
    }

	/**
     * Show login form.
     *
     * @return \Response
     */
	public function getLogin()
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
		// We get the parameters
		$credentials = Input::only(['username', 'password']);
        $remember    = Input::get('remember', false);

        // Login by Email if we detect an '@'
        if (str_contains($credentials['username'], '@')) {
            $credentials['email'] = $credentials['username'];
            unset($credentials['username']);
        }

        if (Auth::attempt($credentials, $remember)) {
            return $this->redirectIntended(route('home'), ['success' => '<p>You were successfully logged in! Enjoy the trip!</p>']);
        }

        return $this->redirectRoute('auth.getLogin', [], ['error' => '<h5>E-mail or password was incorrect, please try again</h5>']);
	}

	/**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        if(Auth::guest()) {
            return $this->redirectRoute('auth.getLogin');
        }

        Auth::logout();

        return $this->redirectRoute('auth.getLogin', [], ['info' => '<p>You were successfully logged out! See you soon!</p>']);
    }

}
