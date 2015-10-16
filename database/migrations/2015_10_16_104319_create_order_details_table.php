<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('order_details', function (Blueprint $table) {
			$table->integer('order_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->integer('price')->unsigned();
			$table->integer('quantity')->unsigned();
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('order_details');
	}
}
