<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	protected $user = [
		'username' => 'Admin',
		'password' => '123456',
	];
	protected $admin = [
		'username' => 'User',
		'password' => '123456',
	];

	public function tearDown()
	{
		Mockery::close();
	}

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	/**
	 * Impersonate a guest
	 */
	public function beGuest() 
	{
		Auth::logout();
		Session::flush();
	}

	/**
	 * Impersonate a user
	 */
	public function beUser() 
	{
		Auth::attempt($this->user);
	}

	/**
	 * Impersonate an admin
	 */
	public function beAdmin() 
	{
		Auth::attempt($this->admin);
	}

}