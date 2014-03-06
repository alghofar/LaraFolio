<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();

		$users = [
			[
				'username'			=> 'Admin',
				'email'				=> 'admin@larafolio.dev',
				'password'			=> Hash::make('123456'),
				'is_admin'			=> 1,
				'suspended'			=> 0,
				'created_at'		=> \Carbon\Carbon::now(),
				'updated_at'		=> \Carbon\Carbon::now(),
				'activation_code'	=> Hash::make(Config::get('app.key')),
				'activated'			=> 1,
			],
			[
				'username'			=> 'User',
				'email'				=> 'user@larafolio.dev',
				'password'			=> Hash::make('123456'),
				'is_admin'			=> 0,
				'suspended'			=> 0,
				'created_at'		=> \Carbon\Carbon::now(),
				'updated_at'		=> \Carbon\Carbon::now(),
				'activation_code'	=> Hash::make(Config::get('app.key')),
				'activated'			=> 1,
			],
			[
				'username'			=> 'Suspended',
				'email'				=> 'suspended@larafolio.dev',
				'password'			=> Hash::make('123456'),
				'is_admin'			=> 0,
				'suspended'			=> 1,
				'created_at'		=> \Carbon\Carbon::now(),
				'updated_at'		=> \Carbon\Carbon::now(),
				'activation_code'	=> Hash::make(Config::get('app.key')),
				'activated'			=> 1,
			]
		];

		DB::table('users')->insert($users);
	}

}