<?php

use think\Route;

Route::get(':version/banner/:id', 'api/:version.Banner/getBanner');

Route::get(':version/theme', 'api/:version.Theme/getSimpleList');
Route::get(':version/theme/:id', 'api/:version.Theme/getComplexOne');