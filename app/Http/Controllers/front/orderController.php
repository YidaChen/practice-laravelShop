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
	 * 創建訂單
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(OrderRequest $request) {
		$carts = Session::get('cart');
		//檢查商品庫存
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
		//創建訂單,訂單商品列表
		$order = $request->all();
		$order['user_id'] = Auth::user()->id;
		$order_id = Order::create($order)->id;
		foreach ($carts as $cart) {
			$cart[0]['order_id'] = $order_id;
			OrderDetail::create($cart[0]);
			//扣除商品庫存
			$item = Item::find($cart[0]["item_id"]);
			$item->quantity -= $cart[0]['quantity'];
			$item->save();
		}
		Session::forget('cart');
		return redirect('order/complete');
	}
	//創建訂單成功頁面
	public function complete() {
		return view('front.orderComplete');
	}
}
