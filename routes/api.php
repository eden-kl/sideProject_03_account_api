<?php

use App\Http\Controllers\Api\v1\AccountController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1'], function () {
    Route::get('account', [AccountController::class, 'getList'])->middleware('ipCheck')->name('api.v1.account.list');
    Route::post('account', [AccountController::class, 'createAccount'])->middleware('ipCheck')->name('api.v1.account.create');
});
