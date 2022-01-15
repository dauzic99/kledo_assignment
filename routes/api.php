<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('pegawai', [App\Http\Controllers\PegawaiController::class, 'index']);
Route::post('pegawai', [App\Http\Controllers\PegawaiController::class, 'store']);

Route::get('kasbon', [App\Http\Controllers\KasbonController::class, 'index']);
Route::post('kasbon', [App\Http\Controllers\KasbonController::class, 'store']);
Route::patch('kasbon/setujui', [App\Http\Controllers\KasbonController::class, 'setujui']);
Route::post('kasbon/setujui-masal', [App\Http\Controllers\KasbonController::class, 'setujui_masal']);
