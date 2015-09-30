<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryItemTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('category_item', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('item_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->timestamps();
		});
		Schema::table('category_item', function (Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('items')
				->onDelete('cascade');
		});

		Schema::table('category_item', function (Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('category_item', function (Blueprint $table) {
			$table->dropForeign('category_item_item_id_foreign');
		});

		Schema::table('category_item', function (Blueprint $table) {
			$table->dropForeign('category_item_category_id_foreign');
		});
		Schema::drop('category_item');
	}
}
