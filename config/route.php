<?php

use \think\Route;

/**
 * 测试
 */
Route::controller('test', 'TestController');

/**
 * 用户登陆
 */
Route::post('user/auth$', 'UserController/login');

/**
 * 获取用户信息
 */
Route::get('loc/all', 'LocController/all');
Route::get('loc/school', 'LocController/school');
Route::get('user/question', 'UserController/getQuestion');
Route::get('user/info', 'UserController/getShareCode');
Route::get('user/getloc', 'UserController/getByShareCode');
Route::post('user/up', 'UserController/updateAddress');
Route::get('user/over', 'UserController/submitQuestion');
Route::get('user/rank', 'UserController/rank');
Route::get('user/inc', 'UserController/shareFunc');

//Route::get('/', '');
