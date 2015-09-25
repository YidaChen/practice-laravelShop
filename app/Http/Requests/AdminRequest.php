<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required|max:30',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:4|confirmed',
			'password_confirmation' => 'required|min:4',
			'role_id' => 'required',
		];
	}
}
