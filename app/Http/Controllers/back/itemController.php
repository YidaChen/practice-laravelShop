<?php

namespace App\Http\Controllers\back;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Item;
use Auth;
use File;
use Illuminate\Http\Request;
use Image;

class itemController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$items = Item::all();
		return view('back.item.itemList', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$categories = Category::lists('category', 'id');
		return view('back.item.itemAdd', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ItemRequest $request) {
		$item = Auth::user()->items()->create($request->all());
		$item->categories()->attach($request->input('category_list'));

		if ($request->file('image')) {
			$imageName = $item->id;
			Image::make($request->file('image'))->fit('800', '300')->encode('jpg', 80)->save(base_path() . '/public/filemanager/userfiles/itemImage/' . $imageName . '.jpg');
		}
		return redirect('/back/item');
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
		$item = Item::findOrFail($id);
		$categories = Category::lists('category', 'id');
		return view('back.item.itemEdit', compact('item', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ItemRequest $request, $id) {
		$item = Item::find($id);
		$item->update($request->all());
		if (empty($request->input('published'))) {
			$item->update(['published' => 0]);
		}
		$item->categories()->sync($request->input('category_list'));

		if ($request->file('image')) {
			$imageName = $item->id;
			Image::make($request->file('image'))->fit('800', '300')->encode('jpg', 80)->save(base_path() . '/public/filemanager/userfiles/itemImage/' . $imageName . '.jpg');
		}
		return redirect('/back/item');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$item = Item::find($id);
		foreach ($item->reviews as $review) {
			$review->delete();
		}
		$item->delete();
		$imagePath = base_path() . '/public/filemanager/userfiles/itemImage/' . $id . '.jpg';
		if (File::exists($imagePath)) {
			File::delete($imagePath);
		}
		return redirect('/back/item');
	}
	public function updatePublished(Request $request, $id) {
		$item = Item::find($id);
		$item->published = $request->input('published') == 'true' ? 1 : 0;
		$item->save();
	}
}
