<?php namespace Tyloo\Services\Mailers;

class UserMailer extends Mailer {

	/**
	 * Outline all the events this class will be listening for.
	 * @param	[type]	$events
	 * @return	void
	 */
	public function subscribe ($events)
	{
		$events->listen ('user.mailer.register',	'Tyloo\Services\Mailers\UserMailer@welcome');
		$events->listen ('user.mailer.resend',		'Tyloo\Services\Mailers\UserMailer@welcome');
		$events->listen ('user.mailer.forgot',		'Tyloo\Services\Mailers\UserMailer@forgotPassword');
		$events->listen ('user.mailer.newpassword',	'Tyloo\Services\Mailers\UserMailer@newPassword');
	}

	/**
	 * Send a welcome email to a new user.
	 * @param	string	$email
	 * @param	int		$userId
	 * @param	string	$activationCode
	 * @return	bool
	 */
	public function welcome($user_id, $email, $token)
	{
		$subject = trans('emails.welcome_title', ['website_name' => trans('pages.website_title')]);
		$view = 'emails.auth.welcome';
		$data['user_id'] = $user_id;
		$data['email'] = $email;
		$data['token'] = $token;

		return $this->sendTo($email, $subject, $view, $data);
	}

	/**
	 * Email Password Reset info to a user.
	 * @param	string	$email
	 * @param	int		$userId
	 * @param	string	$resetCode
	 * @return	bool
	 */
	public function forgotPassword($email, $userId, $resetCode)
	{
		$subject = trans('emails.password_reset_title', ['website_name' => trans('pages.website_title')]);
		$view = 'emails.auth.reset';
		$data['userId'] = $userId;
		$data['resetCode'] = $resetCode;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data);
	}

	/**
	 * Email New Password info to user.
	 * @param	string	$email
	 * @param	int		$userId
	 * @param	string	$resetCode
	 * @return	bool
	 */
	public function newPassword($email, $newPassword)
	{
		$subject = trans('emails.new_password_title', ['website_name' => trans('pages.website_title')]);
		$view = 'emails.auth.newpassword';
		$data['newPassword'] = $newPassword;
		$data['email'] = $email;

		return $this->sendTo($email, $subject, $view, $data);
	}

}