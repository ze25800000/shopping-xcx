<?php

use think\Route;

Route::get(':version/banner/:id', 'api/:version.Banner/getBanner');

Route::get(':version/theme', 'api/:version.Theme/getSimpleList');
Route::get(':version/theme/:id', 'api/:version.Theme/getComplexOne');

Route::get(':version/product/recent', 'api/:version.Product/getRecentProduct');

Route::get(':version/category/all', 'api/:version.Category/getAllCategories');