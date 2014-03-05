<?php namespace Tyloo\Repositories;

use Tyloo\User;

interface UserRepositoryInterface
{

	/**
	 * Find all users paginated.
	 *
	 * @param  int  $perPage
	 * @return \Illuminate\Pagination\Paginator|\User[]
	 */
	public function findAllPaginated($perPage = 200);

	/**
	 * Find a user by its username.
	 *
	 * @param  string $username
	 * @return \Tyloo\User
	 */
	public function findByUsername($username);

	/**
	 * Find a user by its email.
	 *
	 * @param  string $email
	 * @return \Tyloo\User
	 */
	public function findByEmail($email);

	/**
	 * Find a user by its username or its email.
	 *
	 * @param  string $user
	 * @return \Tyloo\User
	 */
	public function findByEmailOrUsername($user);

	/**
	 * Require a user by it's username.
	 *
	 * @param  string $username
	 * @return \Tyloo\User
	 *
	 * @throws \Tyloo\Exceptions\UserNotFoundException
	 */
	public function requireByUsername($username);

	/**
	 * Create a new user in the database.
	 *
	 * @param  array  $data
	 * @return \Tyloo\User
	 */
	public function create(array $data);

	/**
	 * Update the user's settings.
	 *
	 * @param  array $data
	 * @return \Tyloo\User
	 */
	public function updateSettings(User $user, array $data);

	/**
	 * Update the user's profile.
	 *
	 * @param  array $data
	 * @return \Tyloo\User
	 */
	public function updateProfile(User $user, array $data);

}