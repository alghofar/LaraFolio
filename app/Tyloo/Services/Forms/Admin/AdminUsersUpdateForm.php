<?php namespace Tyloo\Services\Forms\Admin;

use Illuminate\Config\Repository;
use Tyloo\Services\Forms\AbstractForm;

class AdminUsersUpdateForm extends AbstractForm
{

	/**
	 * Config repository instance.
	 *
	 * @var \Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * The validation rules to validate the input data against.
	 *
	 * @var array
	 */
	protected $rules = [
		'username'	=> 'required|min:4|alpha_num|unique:users,username',
		'email'		=> 'required|email|min:5|unique:users,email',
		'password'	=> 'min:6|confirmed',
		'first_name' => 'min:2',
		'last_name' => 'min:2',
		'location' => 'min:2',
		'description' => 'min:2',
	];

	/**
	 * Array of custom validation messages.
	 *
	 * @var array
	 */
	protected $messages = [
		'not_in' => 'The selected username is reserved, please try a different username.'
	];

	/**
	 * Create a new RegistrationForm instance.
	 *
	 * @param  \Illuminate\Config\Repository  $config
	 * @return void
	 */
	public function __construct(Repository $config)
	{
		parent::__construct();
		if(empty($this->inputData['password'])) {
			$this->inputData['password'] = str_random(10);
			$this->inputData['password_confirmation'] = $this->inputData['password'];
		}

		$this->config = $config;
	}

	/**
	 * Get the prepared validation rules.
	 *
	 * @return array
	 */
	protected function getPreparedRules()
	{
		$this->rules['username'] .= ',' .$this->inputData['id'];
		$this->rules['email'] .= ',' .$this->inputData['id'];

		$forbidden = $this->config->get('config.forbidden_usernames');
		$forbidden = implode(',', $forbidden);

		$this->rules['username'] .= '|not_in:' . $forbidden;

		return $this->rules;
	}

	/**
	 * Get the prepared input data.
	 *
	 * @return array
	 */
	public function getInputData()
	{
		return array_only($this->inputData, [
			'id', 'username', 'email', 'password', 'password_confirmation', 'first_name', 'last_name', 'location', 'description', 'is_admin'
		]);
	}

	/**
	 * Get the returned formatted data.
	 *
	 * @return array
	 */
	public function getData()
	{
		return array_only($this->inputData, [
			'username', 'email', 'password', 'first_name', 'last_name', 'location', 'description', 'is_admin'
		]);
	}

}