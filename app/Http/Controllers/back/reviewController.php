<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;

class reviewController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$reviews = Review::orderby('id', 'desc')->get();
		return view('back.review.reviewList', compact('reviews'));
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$review = Review::find($id);
		$review->delete();
		return redirect('/back/review');
	}
	/**
	 * 更新已讀評論
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function updateSeen(Request $request, $id) {
		$review = Review::find($id);
		$review->seen = $request->input('seen') == 'true' ? 1 : 0;
		$review->save();
	}
}
