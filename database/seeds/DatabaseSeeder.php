<?php

use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		Role::create([
			'title' => '管理員',
			'slug' => 'admin',
		]);

		Role::create([
			'title' => '編輯',
			'slug' => 'redactor',
		]);

		Role::create([
			'title' => '用戶',
			'slug' => 'user',
		]);
		User::create([
			'name' => 'YidaChen',
			'email' => 'admin@gmail.com',
			'password' => bcrypt('admin'),
			'role_id' => 1,
		]);
	}
}
