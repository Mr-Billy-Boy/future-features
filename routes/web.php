<?php

use App\Http\Controllers\ImageController;

Route::get('/qrcode/encode',                            [ImageController::class, 'encode']);
Route::get('/qrcode/encode/email',                      [ImageController::class, 'encodeEmail']);
Route::get('/qrcode/encode/phone-number',               [ImageController::class, 'encodePhoneNumber']);