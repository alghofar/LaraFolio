<?php namespace Tyloo\Controllers;

//use ImageUpload;
use Illuminate\Support\Facades\Auth;
use Tyloo\Repositories\UserRepositoryInterface;

class UserController extends BaseController {

	/**
     * User Repository.
     *
     * @var \Tyloo\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * The currently authenticated user.
     *
     * @var \User
     */
    protected $user;

	/**
     * Create a new UserController instance.
     *
     * @param  \Tyloo\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users)
    {
        parent::__construct();

        $this->beforeFilter('auth', [ 'except' => 'getPublic' ]);

		$this->user  = Auth::user();
        $this->users = $users;
    }

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function getProfile()
	{
		$user = Auth::user();
        return $this->view('users.profile', compact('user'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Tyloo\User  $user
	 * @return Response
	 */
	public function getPublicProfile($user)
	{
        return View::make('users.show');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postProfile()
	{
		// We populate the form
		$form = $this->users->getUpdateProfileForm();

		// If the entry is not valid, we redirect back with the errors
		if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        // We update the user
        $this->users->updateProfile($this->user, Input::all());

        // We redirect to the profile page
        return $this->redirectRoute('user.settings', [], [ 'settings_updated' => true ]);
	}

}