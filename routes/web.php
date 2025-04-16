<?php

use App\Http\Controllers\MemeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('layout.landingpage'); // Pastikan file berada di resources/views/layout/landingpage.blade.php
// });

Route::get('/auth/login', function () {
    return view('auth.login');
});

Route::get('/auth/register', function () {
    return view('auth.register');
});

Route::get('/dokter/dashboard', function () {
    return view('dokter.dashboard');
});

Route::get('/dokter/obat', [ObatController::class,"dashboard"]);
Route::get('/dokter/obat/create', [ObatController::class,"create"]);
Route::post('/dokter/obat', [ObatController::class,"store"]);
Route::get('/dokter/obat/{id}/edit', [ObatController::class,"edit"]);
Route::put('/dokter/obat/{id}', [ObatController::class,"update"]);
Route::delete('/dokter/obat/{id}', [ObatController::class,"destroy"]);


Route::get('/dokter/memeriksa', [MemeriksaController::class, "dashboard"]);
Route::get('/dokter/memeriksa/{id}', [MemeriksaController::class, "memeriksa"]);
Route::post('/dokter/memeriksa', [MemeriksaController::class, "store"]);
Route::get('/dokter/memeriksa/{id}/edit', [MemeriksaController::class, "edit"]);
Route::put('/dokter/memeriksa/{id}', [MemeriksaController::class, "update"]);



// Route untuk menampilkan daftar pemeriksaan
Route::get('/pasien/periksa', [PeriksaController::class, 'dashboard'])->name('pasien.periksa.index');

// Route untuk menampilkan form create
Route::get('/pasien/periksa/create', [PeriksaController::class, 'create'])->name('pasien.periksa.create');

// Route untuk menyimpan data pemeriksaan (POST)
Route::post('/pasien/periksa', [PeriksaController::class, 'store'])->name('pasien.periksa.store');

Route::get('/pasien/dashboard', function () {
    return view('pasien.dashboard');
});

Route::get('/pasien/riwayat', function () {
    return view('pasien.riwayat');
});

Route::get('/pasien/periksa', [PeriksaController::class, "dashboard"]);
Route::get('/pasien/periksa/create', [PeriksaController::class, "create"]);