<?php

namespace App\Http\Controllers\back;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categoryController extends Controller {
	public function __construct() {
		$this->middleware('IsAdmin', ['only' => ['destroy']]);
	}
	/**
	 * 顯示標籤列表
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$categories = Category::orderby('id', 'desc')->get();
		return view('back.category.categoryList', compact('categories'));
	}

	/**
	 * 創建標籤表單
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('back.category.categoryAdd');
	}

	/**
	 * 儲存標籤
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
	 * 編輯標籤表單
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$category = Category::find($id);
		return view('back.category.categoryEdit', compact('category'));
	}

	/**
	 * 更新標籤
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
	 * 移除標籤
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
