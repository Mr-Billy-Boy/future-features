<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;

Route::get('/qrcode/encode',                            [ImageController::class, 'encode']);
Route::get('/qrcode/encode/email',                      [ImageController::class, 'encodeEmail']);
Route::get('/qrcode/encode/phone-number',               [ImageController::class, 'encodePhoneNumber']);

Route::get('/products/import',                          [ProductController::class, 'import']);

Route::get('/login',                                    [AuthController::class, 'index']);
Route::post('/login-with-google',                       [AuthController::class, 'loginWithGoogle']);

Route::get('/dashboard',                                [DashboardController::class, 'index']);