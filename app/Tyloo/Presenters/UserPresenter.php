<?php namespace Tyloo\Presenters;

use Tyloo\User;
use Gravatar;
use McCool\LaravelAutoPresenter\BasePresenter;

class UserPresenter extends BasePresenter
{
	/**
	 * Create a new UserPresenter instance.
	 *
	 * @param  \Tyloo\User  $user
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->resource = $user;
	}

	/**
	 * Get the user's registration date.
	 *
	 * @return string
	 */
	public function created_at()
	{
		return $this->resource->created_at->diffForHumans();
	}

	/**
	 * Get the user's group.
	 *
	 * @return string
	 */
	public function group()
	{
		return $this->resource->is_admin == 1 ? 'Admin' : 'User';
	}

	/**
	 * Is the user suspended?
	 *
	 * @return string
	 */
	public function suspended()
	{
		return $this->resource->suspended == 1 ? 'Yes' : 'No';
	}

	/**
	 * Get the full name of this user.
	 *
	 * @return string
	 */
	public function fullName()
	{
		$fullName = null;
		if (! empty($this->resource->first_name) && ! empty($this->resource->last_name)) {
			return $this->resource->first_name . ' ' . $this->resource->last_name;
		}

		return $this->resource->username;
	}

	/**
	 * Get the user's avatar image.
	 *
	 * @return string
	 */
	public function avatar()
	{
		if($this->resource->avatar) {
			return url('img/avatar/' . $this->resource->avatar);
		}

		return Gravatar::src($this->resource->email, 100);
	}

}