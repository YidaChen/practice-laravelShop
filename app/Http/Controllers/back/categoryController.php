<?php

namespace App\Http\Controllers\back;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categoryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$categories = Category::all();
		return view('back.category.categoryList', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('back.category.categoryAdd');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'category' => 'required|unique:categories|max:255',
		]);
		$category = new Category;
		$category->create($request->all());
		return redirect('back/category');
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$category = Category::find($id);
		return view('back.category.categoryEdit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, [
			'category' => 'required|unique:categories|max:255',
		]);
		$category = Category::find($id);
		$category->update($request->all());
		return redirect('back/category');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$category = Category::find($id);
		$category->delete();
		return redirect('back/category');
	}
}
