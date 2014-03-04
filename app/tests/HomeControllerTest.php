<?php

class HomeControllerTest extends TestCase {

	/*
	|--------------------------------------------------------------------------
	| Home Page Tests
	|--------------------------------------------------------------------------
	*/

	// GET /
	public function testHomeControllerIndexPage()
	{
		$this->call('GET', '/');

		$this->assertResponseOk();
	}

}