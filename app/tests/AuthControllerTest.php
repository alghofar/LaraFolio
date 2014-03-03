<?php

class AuthControllerTest extends TestCase {

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

	public function test_post_login_form_blank()
	{
		$this->beGuest();

		$this->call('POST', URL::route('auth.postLogin'));
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