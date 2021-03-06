<?php

use think\Route;

Route::get(':version/banner/:id', 'api/:version.Banner/getBanner');

Route::get(':version/theme', 'api/:version.Theme/getSimpleList');
Route::get(':version/theme/:id', 'api/:version.Theme/getComplexOne');

Route::group(':version/product', function () {
    Route::get('/:id', 'api/:version.Product/getOne', [], ['id' => '\d+']);
    Route::get('/recent', 'api/:version.Product/getRecentProduct');
    Route::get('/by_category', 'api/:version.Product/getAllInCategory');
});

Route::get(':version/category/all', 'api/:version.Category/getAllCategories');

Route::post(':version/token/user', 'api/:version.Token/getToken');

Route::post(':version/address', 'api/:version.Address/createOrUpdateAddress');

Route::post(':version/order', 'api/:version.Order/placeOrder');
Route::get(':version/order/:id', 'api/:version.Order/getDetail', [], ['id' => '\d+']);
Route::get(':version/order/by_user', 'api/:version.Order/getSummaryByUser');

Route::post(':version/pay/pre_order', 'api/:version.Pay/getPreOrder');
Route::post(':version/pay/notify', 'api/:version.Pay/receiveNotify');