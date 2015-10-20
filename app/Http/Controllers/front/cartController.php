<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class cartController extends Controller {
	public function __construct() {
		$this->middleware('auth', ['except' => ['store']]);
	}
	/**
	 * 顯示購物車列表
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Session::has('cart')) {
			$carts = Session::get('cart');
			return view('front.cartList', compact('carts'));
		}
	}
	/**
	 * 加入購物車
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if ($request->ajax()) {
			$data = ['item_id' => $request->item_id, 'quantity' => $request->quantity, 'price' => $request->price];
			if (Session::has('cart.' . $request->item_id)) {
				Session::forget('cart.' . $request->item_id);
				Session::push('cart.' . $request->item_id, $data);
			} else {
				Session::push('cart.' . $request->item_id, $data);
			}
			if (Session::has('cart')) {
				return response()->json($data);
			}
		}
	}
	/**
	 * 將商品移除購物車
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function removeItem(Request $request) {
		if ($request->ajax()) {
			Session::forget('cart.' . $request->item_id);
			if (empty(Session::get('cart'))) {
				Session::forget('cart');
				return response()->json('購物車已清空');
			}
		}
	}
}
