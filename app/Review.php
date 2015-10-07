<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {
	protected $fillable = [
		'content',
		'user_id',
		'item_id',
	];
	public function item() {
		return $this->belongsTo('App\Item');
	}
	public function user() {
		return $this->belongsTo('App\User');
	}
}
