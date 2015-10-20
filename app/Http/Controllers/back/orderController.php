<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;

class orderController extends Controller {
	/**
	 * 顯示訂單列表
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$orders = Order::latest('created_at')->get();
		$orderStatuses = OrderStatus::all();
		return view('back.order.orderList', compact('orders', 'orderStatuses'));
	}
	/**
	 * 更新訂單狀態
	 * @param  [type]  $id      [description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function updateStatus($id, Request $request) {
		$order = Order::find($id);
		$order->order_status_id = $request->input('order_status_id');
		$order->save();
		return response()->json($order->orderStatus->status);
	}
	/**
	 * 顯示商品詳情頁
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$order = Order::find($id);
		foreach ($order->details as $detail) {
			$data['item_title'][] = $detail->item->title;
			$data['price'][] = $detail->price;
			$data['quantity'][] = $detail->quantity;
		}
		$order['detail'] = $data;
		return response()->json($order);
	}
}
