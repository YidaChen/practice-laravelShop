<?php

namespace App\Http\Controllers\Auth;

use App\AuthenticateUser;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	 */

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest', ['except' => 'getLogout']);
	}
	protected $redirectPath = '/';
	protected $redirectAfterLogout = '/';
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'name' => 'required|max:30',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'password_confirmation' => 'required|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data) {
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'role_id' => 3,
		]);
	}
	//社群登入
	//http://www.codeanchor.net/blog/complete-laravel-socialite-tutorial/
	public function login(AuthenticateUser $authenticateUser, Request $request, $provider = null) {
		return $authenticateUser->execute($request->all(), $this, $provider);
	}
	public function userHasLoggedIn($user) {
		//Session::flash('message', 'Welcome, ' . $user->username);
		return redirect('/');
	}
}
