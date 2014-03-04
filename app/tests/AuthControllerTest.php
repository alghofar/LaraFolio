<?php

class AuthControllerTest extends TestCase {

	/*
	|--------------------------------------------------------------------------
	| Register Tests
	|--------------------------------------------------------------------------
	*/

	// GET /register
	public function test_get_register_form_guest()
	{
		$this->beGuest();

		$this->call('GET', URL::route('auth.getRegister'));
		$this->assertResponseOk();
	}

	public function test_get_register_form_user()
	{
		$this->beUser();

		$this->call('GET', URL::route('auth.getRegister'));
		$this->assertRedirectedToRoute('users.getProfile');
	}

	// POST /register
	public function test_post_register_form_bad_csrf_token()
	{
		$this->setExpectedException('Illuminate\Session\TokenMismatchException');
		$this->beGuest();

		$this->call('POST', URL::route('auth.postRegister'));
	}

	public function test_post_register_form_blank()
	{
		$this->beGuest();

		$this->call('POST', URL::route('auth.postRegister'), ['IgnoreCSRFTokenError' => true]);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_blank_username()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> '',
			'email'					=> 'test@test.com',
			'password'				=> '123456',
			'password_confirmation'	=> '123456',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_too_small_username()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'A',
			'email'					=> 'test@test.com',
			'password'				=> '123456',
			'password_confirmation'	=> '123456',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_blank_email()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'test',
			'email'					=> '',
			'password'				=> '123456',
			'password_confirmation'	=> '123456',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_blank_password()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'test',
			'email'					=> 'test@test.com',
			'password'				=> '',
			'password_confirmation'	=> '123456',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_blank_password_confirmation()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'test',
			'email'					=> 'test@test.com',
			'password'				=> '123456',
			'password_confirmation'	=> '',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_blank_mismatch_password()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'test',
			'email'					=> 'test@test.com',
			'password'				=> '123456',
			'password_confirmation'	=> '12345',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_username_already_taken()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'Admin',
			'email'					=> 'test@test.com',
			'password'				=> '123456',
			'password_confirmation'	=> '123456',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_email_already_taken()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'test',
			'email'					=> 'admin@larafolio.dev',
			'password'				=> '123456',
			'password_confirmation'	=> '123456',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_guarded_username()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'login',
			'email'					=> 'test@test.com',
			'password'				=> '123456',
			'password_confirmation'	=> '123456',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('auth.getRegister');
		$this->assertSessionHas('errors');
	}

	public function test_post_register_form_success()
	{
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'test',
			'email'					=> 'test@test.com',
			'password'				=> '123456',
			'password_confirmation'	=> '123456',
		]);

		$this->call('POST', URL::route('auth.postRegister'), $input);
		$this->assertRedirectedToRoute('home');
		$this->assertSessionHas('success');
	}

	/*
	|--------------------------------------------------------------------------
	| Login Tests
	|--------------------------------------------------------------------------
	*/

	// GET /login
	public function test_get_login_form_guest()
	{
		$this->beGuest();

		$this->call('GET', URL::route('auth.getLogin'));
		$this->assertResponseOk();
	}

	public function test_get_login_form_user()
	{
		$this->beUser();

		$this->call('GET', URL::route('auth.getLogin'));
		$this->assertRedirectedToRoute('users.getProfile');
	}

	// POST /login
	public function test_post_login_form_bad_csrf_token()
	{
		$this->setExpectedException('Illuminate\Session\TokenMismatchException');
		$this->beGuest();

		$this->call('POST', URL::route('auth.postLogin'));
	}

	public function test_post_login_form_blank()
	{
		$this->beGuest();

		$this->call('POST', URL::route('auth.postLogin'), ['IgnoreCSRFTokenError' => true]);
		$this->assertRedirectedToRoute('auth.getLogin');
		$this->assertSessionHas('error');
	}

	public function test_post_login_form_bad_credentials() {
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username' => 'test@test.com',
			'password' => 'badcredentials',
		]);

		$this->call('POST', URL::route('auth.postLogin'), $input);
		$this->assertRedirectedToRoute('auth.getLogin');
		$this->assertSessionHas('error');
	}

	public function test_post_login_form_success() {
		$this->beGuest();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username' => $this->user['username'],
			'password' => $this->user['password'],
		]);

		$this->call('POST', URL::route('auth.postLogin'), $input);
		$this->assertRedirectedToRoute('home');
		$this->assertSessionHas('success');
	}

	/*
	|--------------------------------------------------------------------------
	| Logout Tests
	|--------------------------------------------------------------------------
	*/

	// GET /logout
	public function test_get_logout_not_logged_in() {
		$this->beGuest();

		$this->call('GET', URL::route('auth.getLogout'));
		$this->assertRedirectedToRoute('auth.getLogin');
	}

	public function test_get_logout_logged_in() {
		$this->beUser();

		$this->call('GET', URL::route('auth.getLogout'));
		$this->assertRedirectedToRoute('auth.getLogin');
		$this->assertSessionHas('info');
	}

}