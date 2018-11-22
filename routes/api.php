<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(
    function () {
        Route::any('/video', 'Api\v1\VideoController@video');
        Route::any('/video/{tag}', 'Api\v1\VideoController@videobytag');
        Route::any('/tag', 'Api\v1\VideoController@tags');
    }
);
