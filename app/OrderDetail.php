<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {
	protected $fillable = [
		'order_id',
		'item_id',
		'price',
		'quantity',
	];
	public function order() {
		return $this->belongsTo('App\Order');
	}
	public function item() {
		return $this->belongsTo('App\Item');
	}
}
