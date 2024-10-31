<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\ObatController;

Route::get('/', function () {
    return view('template.index');
});


Route::get('obats', [ObatController::class, 'index'])->name('obats.index');
Route::get('obats/create', [ObatController::class, 'create'])->name('obats.create');
Route::post('obats', [ObatController::class, 'store'])->name('obats.store');
Route::get('obats/{id}/edit', [ObatController::class, 'edit'])->name('obats.edit');
Route::get('obats/{id}/show', [ObatController::class, 'show'])->name('obats.show');
Route::put('obats/{id}', [ObatController::class, 'update'])->name('obats.update');
Route::delete('obats/{id}', [ObatController::class, 'destroy'])->name('obats.destroy');

Route::get('pelanggans', [PelangganController::class, 'index'])->name('pelanggans.index');
Route::get('pelanggans/create', [PelangganController::class, 'create'])->name('pelanggans.create');
Route::post('pelanggans', [PelangganController::class, 'store'])->name('pelanggans.store');
Route::get('pelanggans/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggans.edit');
Route::get('pelanggans/{id}/show', [PelangganController::class, 'show'])->name('pelanggans.show');
Route::put('pelanggans/{id}', [PelangganController::class, 'update'])->name('pelanggans.update');
Route::delete('pelanggans/{id}', [PelangganController::class, 'destroy'])->name('pelanggans.destroy');

Route::get('stafs', [StafController::class, 'index'])->name('stafs.index');
Route::get('stafs/create', [StafController::class, 'create'])->name('stafs.create');
Route::post('stafs', [StafController::class, 'store'])->name('stafs.store');
Route::get('stafs/{id}/edit', [StafController::class, 'edit'])->name('stafs.edit');
Route::get('stafs/{id}/show', [StafController::class, 'show'])->name('stafs.show');
Route::put('stafs/{id}', [StafController::class, 'update'])->name('stafs.update');
Route::delete('stafs/{id}', [StafController::class, 'destroy'])->name('stafs.destroy');

Route::get('daftar', [PendaftarController::class, 'index'])->name('pendaftaran.index');
Route::get('pendaftaran', [PendaftarController::class, 'create'])->name('pendaftaran.create');
Route::post('pendaftaran', [PendaftarController::class, 'store'])->name('pendaftaran.store');
Route::get('pendaftaran/{id}/edit', [PendaftarController::class, 'edit'])->name('pendaftaran.edit');
Route::get('pendaftaran/{id}/show', [PendaftarController::class, 'show'])->name('pendaftaran.show');
Route::put('pendaftaran/{id}', [PendaftarController::class, 'update'])->name('pendaftaran.update');
Route::delete('pendaftaran/{id}', [PendaftarController::class, 'destroy'])->name('pendaftaran.destroy');

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::get('products/{id}/show', [ProductController::class, 'show'])->name('products.show');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
