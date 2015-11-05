<?php
//後台路由
Route::group(['middleware' => ['auth', 'NotUser'], 'prefix' => 'back', 'namespace' => 'back'], function () {
	//後臺主頁
	Route::get('/', 'backController@index');
	//管理員 資源(增刪查改)
	Route::resource('admin', 'adminController');
	//標籤 資源(增刪查改)
	Route::resource('category', 'categoryController');
	//商品 資源(增刪查改)
	Route::resource('item', 'itemController');
	//AJAX更新商品發布
	Route::put('item/updatePublished/{id}', 'itemController@updatePublished');
	//評論 資源(增刪查改)
	Route::resource('review', 'reviewController');
	//AJAX更新已讀評論
	Route::put('review/updateSeen/{id}', 'reviewController@updateSeen');
	//訂單列表
	Route::get('order', 'orderController@index');
	//訂單商品清單
	Route::post('order/{id}', 'orderController@show');
	//更新訂單狀態
	Route::put('order/updateStatus/{id}', 'orderController@updateStatus');
});
//檔案管理路由
Route::group(['middleware' => ['auth', 'NotUser', 'IsAdmin']], function () {
	Route::controller('filemanager', 'FilemanagerLaravelController');
});
//前台路由
Route::group(['namespace' => 'front'], function () {
	//商品詳情頁
	Route::get('/item={id}', 'ShopController@show');
	//無限滾動
	Route::get('/infiniteScroll', 'ShopController@infiniteScroll');
	//商品標題搜尋
	Route::get('search', 'ShopController@search');
	//首頁,顯示商品列表, url可傳入標籤搜尋
	Route::get('/{category?}', 'ShopController@index');
	//評論發布
	Route::post('storeReview', 'reviewController@store');
	//添加商品至購物車
	Route::post('cart/addItem', 'cartController@store');
	//顯示購物車商品列表
	Route::get('cart/show', 'cartController@index');
	//移除購物車商品
	Route::post('cart/removeItem', 'cartController@removeItem');
	//結帳, 創建訂單
	Route::post('order/checkout', 'orderController@store');
	//結帳完成顯示頁
	Route::get('order/complete', 'orderController@complete');
	//用戶專區主頁
	Route::get('user/index', 'User\UserController@index');
	//用戶的訂單列表
	Route::get('user/order', 'User\UserController@orderList');
});

// 認證路由
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 註冊路由
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//社群認證路由
Route::get('login/{provider?}', 'Auth\AuthController@login');