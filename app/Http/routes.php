<?php

Route::get('/', function () {
	return view('front.shopIndex');
});
Route::get('/item', function () {
	return view('front.shopItem');
});
Route::get('/login', function () {
	return view('auth.login');
});
Route::get('/back', function () {
	return view('back/backIndex');
});