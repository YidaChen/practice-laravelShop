<?php
namespace App\Http\Controllers\front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;

class ShopController extends Controller {
	/**
	 * 顯示商品列表
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($category = null) {
		if (isset($category)) {
			$category = Category::where('category', $category)->firstOrFail();
			$items = $category->items()->where('published', 1)->latest('created_at')->paginate(9);
		} else {
			$items = Item::where('published', 1)->latest('created_at')->paginate(9);
		}
		$categories = Category::get();
		if (Item::where('published', 1)->count() > 2) {
			$take3Items = Item::where('published', 1)->latest('updated_at')->take(3)->get();
		}
		return view('front.shopIndex', compact('items', 'categories', 'take3Items'));
	}
	//搜尋商品
	public function search(Request $search) {
		$search = $search->input('search');
		$items = Item::where('title', 'LIKE', '%' . $search . '%')
			->latest('created_at')->paginate(9);
		$categories = Category::get();
		return view('front.shopIndex', compact('items', 'categories'));
	}
	/**
	 * 顯示特定商品
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
}
