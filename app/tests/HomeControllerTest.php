<?php

class HomeControllerTest extends TestCase {

	/**
	 * Home Page Test
	 *
	 * @return void
	 */
	public function testHomeControllerIndexPage()
	{
		$this->call('GET', '/');

		$this->assertResponseOk();
	}

}