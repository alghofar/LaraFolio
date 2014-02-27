<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();

		$users = [
			[
				'username'      => 'Tyloo',
				'email'         => 'jbonva@gmail.com',
				'password'      => Hash::make('123456'),
				'is_admin'      => '1',
				'created_at'    => \Carbon\Carbon::now(),
				'updated_at'    => \Carbon\Carbon::now(),
			]
		];

		DB::table('users')->insert($users);
	}

}