<?php
namespace App\Http\Controllers\front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;

class ShopController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($category = null) {
		if (isset($category)) {
			$category = Category::where('category', $category)->firstOrFail();
			$items = $category->items()->where('published', 1)->latest('created_at')->get();
		} else {
			$items = Item::where('published', 1)->latest('created_at')->get();
		}
		$categories = Category::get();
		return view('front.shopIndex', compact('items', 'categories'));
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$item = Item::find($id);
		if ($item->published) {
			$categories = Category::get();
			return view('front.shopItem', compact('item', 'categories'));
		}
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
