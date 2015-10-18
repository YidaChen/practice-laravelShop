<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;

class orderController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$orders = Order::latest('created_at')->get();
		$orderStatuses = OrderStatus::all();
		return view('back.order.orderList', compact('orders', 'orderStatuses'));
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
	public function store(Request $request) {
		//
	}
	public function updateStatus($id, Request $request) {
		$order = Order::find($id);
		$order->order_status_id = $request->input('order_status_id');
		$order->save();
		return response()->json($order->orderStatus->status);
	}
	/**
	 * Display the specified resource.
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
}
