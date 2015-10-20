<?php

namespace App\Http\Controllers\front\User;

use App\Http\Controllers\Controller;
use App\Order;
use Auth;

class UserController extends Controller {
	/**
	 * 用戶專區主頁
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();
		return view('front.user.userIndex', compact('user'));
	}
	//用戶的訂單列表
	public function orderList() {
		$user_id = Auth::user()->id;
		$orders = Order::where('user_id', '=', $user_id)->latest('created_at')->get();
		return view('front.user.orderList', compact('orders'));
	}
}
