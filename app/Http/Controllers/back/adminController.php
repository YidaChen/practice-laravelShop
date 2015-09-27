<?php
namespace App\Http\Controllers\back;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminEditRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class adminController extends Controller {
	public function __construct() {
		$this->middleware('IsAdmin', ['except' => ['index']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$users = User::all();
		return view('back.admin.adminList', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$roles = Role::all();
		return view('back.admin.adminAdd', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
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
	 * Show the form for editing the specified resource.
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
	 * Update the specified resource in storage.
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
	 * Remove the specified resource from storage.
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
