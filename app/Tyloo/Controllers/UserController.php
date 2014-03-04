<?php namespace Tyloo\Controllers;

//use ImageUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
	 * @var \Tyloo\User
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

		$this->user  = Auth::user();
		$this->users = $users;
	}

	/**
	 * Display the User Settings resource.
	 *
	 * @return Response
	 */
	public function getSettings()
	{
		$user = Auth::user();
		return $this->view('users.settings', compact('user'));
	}

	/**
	 * Update the User Settings resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postSettings()
	{
		// We populate the form
		$form = $this->users->getSettingsForm();

		// If the entry is not valid, we redirect back with the errors
		if ( ! $form->isValid()) {
			return $this->redirectRouteInput('users.getSettings', [], ['errors' => $form->getErrors()]);
		}

		// We update the user
		$this->users->updateSettings($this->user, Input::all());

		// We redirect to the profile page
		return $this->redirectRoute('users.getSettings', [], ['success' => '<p>Your Settings have been updated!</p>']);
	}

	/**
	 * Display the User Profile resource.
	 *
	 * @return Response
	 */
	public function getProfile()
	{
		$user = Auth::user();
		return $this->view('users.profile', compact('user'));
	}

	/**
	 * Update the User Profile resource in storage.
	 *
	 * @return Response
	 */
	public function postProfile()
	{
		// We populate the form
		$form = $this->users->getProfileForm();

		// If the entry is not valid, we redirect back with the errors
		if ( ! $form->isValid()) {
			return $this->redirectRouteInput('users.getProfile', [], ['errors' => $form->getErrors()]);
		}

		// We update the user
		$this->users->updateProfile($this->user, Input::all());

		// We redirect to the profile page
		return $this->redirectRoute('users.getProfile', [], ['success' => '<p>Your Profile have been updated!</p>']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $username
	 * @return Response
	 */
	public function getProfilePublic($username)
	{
		$user = $this->users->findByUsername($username);
		return $user;
		return $this->view('users.profilePublic', compact('user'));
	}

}