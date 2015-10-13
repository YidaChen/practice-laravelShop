<?php namespace App\Repositories;

use App\User;

class UserRepository {
	public function findByUserNameOrCreate($userData, $provider) {
		$user = User::where('provider_id', '=', $userData->id)->first();
		$existEmail = User::where('email', '=', $userData->email)->first();
		if (!$user && !$existEmail) {
			$user = User::create([
				'provider_id' => $userData->id,
				'name' => $userData->name,
				'username' => $userData->nickname,
				'email' => $userData->email,
				'avatar' => $userData->avatar,
				'role_id' => 3,
				'provider' => $provider,
			]);
		} elseif (!$user && $existEmail) {
			$user = $existEmail->update([
				'provider_id' => $userData->id,
				'name' => $userData->name,
				'username' => $userData->nickname,
				'avatar' => $userData->avatar,
				'provider' => $provider,
			]);
			$user = User::where('provider_id', '=', $userData->id)->first();
		} else {
			$this->checkIfUserNeedsUpdating($userData, $user, $provider);
		}
		return $user;
	}

	public function checkIfUserNeedsUpdating($userData, $user, $provider) {

		$socialData = [
			'email' => $userData->email,
			'name' => $userData->name,
			'username' => $userData->nickname,
		];
		$dbData = [
			'email' => $user->email,
			'name' => $user->name,
			'username' => $user->username,
		];

		if (!empty(array_diff($socialData, $dbData))) {
			$user->email = $userData->email;
			$user->name = $userData->name;
			$user->username = $userData->nickname;
			$user->save();
		}
	}
}