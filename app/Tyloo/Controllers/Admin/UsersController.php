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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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

	/**
	 * Suspend the user
	 * @param  int $id
	 * @return void
	 */
	public function suspend($id)
	{
		//
	}

	/**
	 * Restore the user
	 * @param  int $id
	 * @return void
	 */
	public function restore($id)
	{
		//
	}

}