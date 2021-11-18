<?php

use App\Http\Controllers\ImageController;

Route::get('/qrcode/generate',           [ImageController::class, 'qrCode']);