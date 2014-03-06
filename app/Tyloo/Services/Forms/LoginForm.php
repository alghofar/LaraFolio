<?php namespace Tyloo\Services\Forms;

use Illuminate\Config\Repository;

class LoginForm extends AbstractForm
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
		'username'	=> 'required|min:4|alpha_num',
		'password'	=> 'required|min:6'
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

		$this->config = $config;
	}

	/**
	 * Get the prepared validation rules.
	 *
	 * @return array
	 */
	protected function getPreparedRules()
	{
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
			'username', 'password', 'remember'
		]);
	}

}