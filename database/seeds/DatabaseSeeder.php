<?php

use App\OrderStatus;
use App\Role;
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

		OrderStatus::create([
			'status' => '訂單已取消',
		]);
		OrderStatus::create([
			'status' => '訂單確認中',
		]);
		OrderStatus::create([
			'status' => '訂單已成立',
		]);
		OrderStatus::create([
			'status' => '商品已出貨',
		]);

	}
}
