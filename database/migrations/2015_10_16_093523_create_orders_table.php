<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('total_price')->unsigned();
			$table->string('addressee');
			$table->string('phone');
			$table->string('local_calls')->nullable();
			$table->smallInteger('postal_code')->unsigned();
			$table->text('address');
			$table->tinyInteger('pay_id')->unsigned();
			$table->tinyInteger('order_status_id')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('orders');
	}
}
