<?php

class AuthControllerTest extends TestCase {

	public function testGetLoginForm()
	{
		$this->call('GET', 'login');
		$this->assertResponseOk();
	}

	public function testPostLoginForm()
	{
		$this->call('POST', 'login');
		$this->assertResponseOk();
	}

}