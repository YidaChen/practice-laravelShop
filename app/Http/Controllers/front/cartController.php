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
	 * Display a listing of the resource.
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
