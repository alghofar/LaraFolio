<?php

class AdminUsersControllerTest extends TestCase {

	/*
	|--------------------------------------------------------------------------
	| Users Admin Tests
	|--------------------------------------------------------------------------
	*/

	// GET /admin/users
	public function test_get_admin_users_page()
	{
		$this->beAdmin();

		$this->call('GET', route('admin.users.index'));
		$this->assertResponseOk();
	}
}