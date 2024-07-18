<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$Service = 'product';

Route::group([
    'prefix' => $Service
], function () {
    Route::get('', function () {
        return response()->json([
            'msg' => 'Beep Beep Service Products is online'
        ]);
    });
});
