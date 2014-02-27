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
     * Create a new UserController instance.
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
        return $this->view('users.register');
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
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        // We create the user
        if ($user = $this->users->create($form->getInputData())) {
            Auth::login($user);

            return $this->redirectRoute('user.index', [], [ 'first_use' => true ]);
        }

        return $this->redirectRoute('home');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('users.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
