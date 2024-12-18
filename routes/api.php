<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));

//posts
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);

Route::apiResource('data-pelanggan', App\Http\Controllers\Api\DataPelanggannController::class);
Route::apiResource('data-kendaraan', App\Http\Controllers\Api\DataKendaraanController::class);
Route::apiResource('daftar-servis', App\Http\Controllers\Api\DaftarServisController::class);
Route::apiResource('data-servis', App\Http\Controllers\Api\DataServisController::class);
Route::apiResource('pembayaran', App\Http\Controllers\Api\PembayaranController::class);
