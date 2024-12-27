<?php

use App\Http\Controllers\Api\v1\AccountController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1'], function () {
    Route::get('accounts', [AccountController::class, 'getList'])->middleware('ipCheck')->name('api.v1.accounts.list');
    Route::post('accounts', [AccountController::class, 'createAccount'])->middleware('ipCheck')->name('api.v1.accounts.create');
    Route::delete('accounts/{id}', [AccountController::class, 'deleteAccount'])->middleware('ipCheck')->name('api.v1.accounts.delete');
    Route::put('accounts/{id}', [AccountController::class, 'updateAccount'])->middleware('ipCheck')->name('api.v1.accounts.update');
});
