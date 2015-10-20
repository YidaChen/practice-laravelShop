<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Review;
use Auth;
use Illuminate\Http\Request;

class reviewController extends Controller {
	/**
	 * 儲存商品評論
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if ($request->ajax()) {
			$data = Review::create($request->all());
			$data['user'] = Auth::user()->name;
			$data['time'] = $data['created_at']->format('Y-m-d H:i');
			return response()->json($data);
		}
	}
}
