<?php namespace Tyloo\Controllers\Admin;

use Tyloo\Controllers\BaseController;
use Tyloo\Repositories\UserRepositoryInterface;

class UsersController extends BaseController
{

	/**
     * User repository.
     *
     * @var \Tyloo\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new UsersController instance.
     *
     * @param  \Tricks\Repositories\UserRepositoryInterface $users
     * @return Tyloo
     */
    public function __construct(UserRepositoryInterface $users)
    {
        parent::__construct();

        $this->users = $users;
    }

	/**
     * Show the users index page.
     *
     * @return \Response
     */
	public function index()
	{
		$users = $this->users->findAllPaginated();

        $this->view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		dd(\Input::all());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->users->findById($id);
		return $this->view('admin.users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		dd(\Input::all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->users->findById($id);
		$this->users->delete($user);
		return $this->redirectRoute('admin.users.index', ['success' => '<p>User \'' . $user->username . '\' deleted successfully!']);
	}

	/**
	 * Suspend the user
	 * @param  int $id
	 * @return void
	 */
	public function suspend($id)
	{
		$user = $this->users->findById($id);
		$this->users->suspend($user);
		return $this->redirectRoute('admin.users.index', ['success' => '<p>User \'' . $user->username . '\' suspended successfully!']);
	}

	/**
	 * Restore the user
	 * @param  int $id
	 * @return void
	 */
	public function restore($id)
	{
		$user = $this->users->findById($id);
		$this->users->restore($user);
		return $this->redirectRoute('admin.users.index', ['success' => '<p>User \'' . $user->username . '\' restored successfully!']);
	}

}