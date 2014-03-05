<?php namespace Tyloo;

use Gravatar;
use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Model implements UserInterface, RemindableInterface
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];

	/**
	 * The attributes that should be filled in.
	 *
	 * @var array
	 */
	protected $fillable = ['email', 'username', 'password', 'first_name', 'last_name', 'location', 'description', 'avatar'];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the user's avatar image.
	 *
	 * @return string
	 */
	public function getPhotocssAttribute()
	{
		if($this->avatar) {
			return url('img/avatar/' . $this->avatar);
		}

		return Gravatar::src($this->email, 100);
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Check user's permissions
	 *
	 * @return bool
	 */
	public function isAdmin()
	{
		return ($this->is_admin == true);
	}

}