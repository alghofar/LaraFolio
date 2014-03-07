<?php namespace Tyloo\Controllers\Admin;

use Tyloo\Repositories\UserRepositoryInterface;
use Tyloo\Services\AuthEvents;

class UsersController extends AdminController
{

	/**
     * User repository.
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
     * Create a new UsersController instance.
     *
     * @param  \Tricks\Repositories\UserRepositoryInterface $users
     * @return Tyloo
     */
    public function __construct(UserRepositoryInterface $users, AuthEvents $authEvent)
    {
        parent::__construct();

        $this->users = $users;
        $this->authEvent = $authEvent;
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
		if ( ! $this->authEvent->create()) {
			return $this->redirectRouteInput('admin.users.create', $this->authEvent->errors());
		}

		return $this->redirectRoute('admin.users.index', ['success' => '<p>User added successfully!</p>']);
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
		if ( ! $this->authEvent->update($id)) {
			return $this->redirectRouteInput('admin.users.edit', $this->authEvent->errors(), ['id' => $id]);
		}

		return $this->redirectRoute('admin.users.index', ['success' => '<p>User added successfully!</p>']);
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