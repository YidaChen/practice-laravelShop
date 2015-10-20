<?php
namespace App\Http\Controllers\back;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminEditRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class adminController extends Controller {
	//檢查是否為管理員的middleware,除了管理員顯示
	public function __construct() {
		$this->middleware('IsAdmin', ['except' => ['index']]);
	}
	/**
	 * 顯示管理員列表
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$users = User::orderby('id', 'desc')->get();
		return view('back.admin.adminList', compact('users'));
	}
	/**
	 * 顯示創建用戶頁面
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$roles = Role::all();
		return view('back.admin.adminAdd', compact('roles'));
	}

	/**
	 * 儲存創建用戶的表單
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(AdminAddRequest $request) {
		$user = $request->all();
		$user['password'] = bcrypt($user['password']);
		User::create($user);
		return redirect('back/admin');
	}
	/**
	 * 顯示編輯用戶表單
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$user = User::find($id);
		$roles = Role::all();
		return view('back.admin.adminEdit', compact('user', 'roles'));
	}

	/**
	 * 更新用戶
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(AdminEditRequest $request, $id) {
		$request = $request->all();
		$request['password'] = bcrypt($request['password']);
		$user = User::find($id);
		$user->update($request);
		return redirect('back/admin');
	}

	/**
	 * 移除使用者
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user = User::find($id);
		$user->delete();
		return redirect('back/admin');
	}
}
