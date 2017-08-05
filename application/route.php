<?php

use think\Route;

Route::get(':version/banner/:id', 'api/:version.Banner/getBanner');