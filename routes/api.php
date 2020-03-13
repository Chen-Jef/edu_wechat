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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//获取变量类型
Route::get('getVariableType','Api\SystemConfigController@getVariableType');

/**
 * 免校验的接口
 */
Route::namespace('Api')->group(function () {
    //获取首页功能模块
    Route::get('getIndex','IndexController@index');

    /**
     * 微信登录模块
     */
    Route::get('doLogin','LoginController@doLogin');

});

/**
 * 需要校验Token的接口
 */
Route::namespace('Api')->middleware('token')->group(function () {

    /**
     * Diary模块
     */
    Route::get('getUserDiaryPageList','DiaryController@getUserDiaryPageList');
    Route::post('addDiary','DiaryController@addDiary');

    /**
     * Album
     */
    Route::post('addAlbum','AlbumController@addAlbum');
});


