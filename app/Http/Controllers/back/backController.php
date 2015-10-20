<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Order;
use App\Review;

class backController extends Controller {
	/**
	 * 計算新訂單和評論的數量，傳回後台首頁模板
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$newReviewsNum = Review::where('seen', 0)->count();
		$newOrdersNum = Order::where('order_status_id', 2)->count();
		return view('back.backIndex', compact('newReviewsNum', 'newOrdersNum'));
	}
}
