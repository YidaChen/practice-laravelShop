<?php

namespace App\Http\Controllers\back;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Item;
use Auth;
use Illuminate\Http\Request;

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
		$item->categories()->sync($request->input('category_list'));
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
		$item->delete();
		return redirect('/back/item');
	}
}
