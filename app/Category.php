<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $table = 'categories';
	protected $fillable = ['category'];

	public function items() {
		return $this->belongsToMany('App\Item')->withTimestamps();
	}
}
