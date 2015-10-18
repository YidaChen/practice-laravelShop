<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Item;
use App\Order;
use App\OrderDetail;
use Auth;
use Illuminate\Http\Request;
use Session;

class orderController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(OrderRequest $request) {
		$carts = Session::get('cart');
		$message = '';
		foreach ($carts as $cart) {
			$item = Item::find($cart[0]["item_id"]);
			if ((int) $cart[0]["quantity"] > $item->quantity) {
				$message .= $item->title . ' ,';
			}
		}
		if ($message != '') {
			Session::flash('flash_message', '很抱歉，商品: ' . $message . '庫存不足，請返回該商品頁查看庫存');
			Session::flash('flash_message_important', true);
			return redirect()->back()->withInput();
		}
		$order = $request->all();
		$order['user_id'] = Auth::user()->id;
		$order_id = Order::create($order)->id;
		foreach ($carts as $cart) {
			$cart[0]['order_id'] = $order_id;
			OrderDetail::create($cart[0]);
			$item = Item::find($cart[0]["item_id"]);
			$item->quantity -= $cart[0]['quantity'];
			$item->save();
		}
		Session::forget('cart');
		return redirect('order/complete');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
	public function complete() {
		return view('front.orderComplete');
	}
}
