<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
	protected $fillable = [
		'title',
		'summary',
		'content',
		'price',
	];
	public function categories() {
		return $this->belongsToMany('App\Category');
	}
	public function user() {
		return $this->belongsTo('App\User');
	}
	public function getCategoryListAttribute() {
		// laravel 5.1 needs all()
		return $this->categories->lists('id')->all();
		// tags means tags() many-to-many relationship with tag
	}
}
