<?php

class UserControllerTest extends TestCase {

	/*
	|--------------------------------------------------------------------------
	| Settings Tests
	|--------------------------------------------------------------------------
	*/

	// GET /settings
	public function test_get_settings_page_guest()
	{
		$this->beGuest();

		$this->call('GET', URL::route('users.getSettings'));
		$this->assertRedirectedToRoute('auth.getLogin');
	}

	public function test_get_settings_page_user()
	{
		$this->beUser();

		$this->call('GET', URL::route('users.getSettings'));
		$this->assertResponseOk();
	}

	// POST /settings
	public function test_post_settings_form_bad_csrf_token()
	{
		$this->setExpectedException('Illuminate\Session\TokenMismatchException');
		$this->beUser();

		$this->call('POST', URL::route('users.postSettings'));
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_blank()
	{
		$this->beUser();

		$this->call('POST', URL::route('users.postSettings'), ['IgnoreCSRFTokenError' => true]);
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_blank_username() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> '',
		]);

		$this->call('POST', URL::route('users.postSettings'), $input);
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_too_small_username() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'A',
		]);

		$this->call('POST', URL::route('users.postSettings'), $input);
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_blank_password_confirmation() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> $this->user['username'],
			'password'				=> $this->user['password'],
			'password_confirmation'	=> '',
		]);

		$this->call('POST', URL::route('users.postSettings'), $input);
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_blank_mismatch_password() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> $this->user['username'],
			'password'				=> $this->user['password'],
			'password_confirmation'	=> $this->user['bad_password'],
		]);

		$this->call('POST', URL::route('users.postSettings'), $input);
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_username_already_taken() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> $this->admin['username'],
		]);

		$this->call('POST', URL::route('users.postSettings'), $input);
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_guarded_username() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'login',
		]);

		$this->call('POST', URL::route('users.postSettings'), $input);
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_success() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'username'				=> 'NewUsername',
			'password'				=> 'newpass',
			'password_confirmation'	=> 'newpass',
		]);

		$this->call('POST', URL::route('users.postSettings'), $input);
		$this->assertRedirectedToRoute('users.getSettings');
		$this->assertSessionHas('success');
	}

	/*
	|--------------------------------------------------------------------------
	| Profile Tests
	|--------------------------------------------------------------------------
	*/

	// GET /profile
	public function test_get_profile_page_guest()
	{
		$this->beGuest();

		$this->call('GET', URL::route('users.getProfile'));
		$this->assertRedirectedToRoute('auth.getLogin');
	}

	public function test_get_profile_page_user()
	{
		$this->beUser();

		$this->call('GET', URL::route('users.getProfile'));
		$this->assertResponseOk();
	}

	// POST /profile
	public function test_post_profile_form_bad_csrf_token()
	{
		$this->setExpectedException('Illuminate\Session\TokenMismatchException');
		$this->beUser();

		$this->call('POST', URL::route('users.postProfile'));
		$this->assertRedirectedToRoute('users.getProfile');
		$this->assertSessionHas('errors');
	}

	public function test_post_settings_form_too_small_first_name() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'first_name'			=> 'J',
		]);

		$this->call('POST', URL::route('users.postProfile'), $input);
		$this->assertRedirectedToRoute('users.getProfile');
		$this->assertSessionHas('errors');
	}

	public function test_post_profile_form_success() {
		$this->beUser();

		Input::replace($input = [
			'IgnoreCSRFTokenError' => true,
			'first_name'	=> $this->user['first_name'],
			'last_name'		=> $this->user['last_name'],
			'location'		=> $this->user['location'],
			'description'	=> $this->user['description'],
		]);

		$this->call('POST', URL::route('users.postProfile'), $input);
		$this->assertRedirectedToRoute('users.getProfile');
		$this->assertSessionHas('success');
	}

}