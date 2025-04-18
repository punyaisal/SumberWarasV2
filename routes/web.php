<?php 
// routes/web.php
use App\Http\Controllers\MemeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserRole;

// Rute autentikasi manual
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk pasien dengan middleware
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::prefix('pasien')->group(function() {
        // Dashboard pasien
        Route::get('/dashboard', function () {
            return view('pasien.dashboard');
        })->name('pasien.dashboard');
        
        // Riwayat pasien
        Route::get('/riwayat', function () {
            return view('pasien.riwayat');
        })->name('pasien.riwayat');
        
        // Route periksa
        Route::get('/periksa', [PeriksaController::class, 'dashboard'])->name('pasien.periksa.index');
        Route::get('/periksa/create', [PeriksaController::class, 'create'])->name('pasien.periksa.create');
        Route::post('/periksa', [PeriksaController::class, 'store'])->name('pasien.periksa.store');
    });
});

// Route untuk dokter dengan middleware
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::prefix('dokter')->group(function() {
        // Dashboard dokter
        Route::get('/dashboard', function () {
            return view('dokter.dashboard');
        })->name('dokter.dashboard');
        
        // Route obat
        Route::get('/obat', [ObatController::class, 'dashboard'])->name('dokter.obat.index');
        Route::get('/obat/create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/obat', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::put('/obat/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
        
        // Route memeriksa
        Route::get('/memeriksa', [MemeriksaController::class, 'dashboard'])->name('dokter.memeriksa.index');
        Route::get('/memeriksa/{id}', [MemeriksaController::class, 'memeriksa'])->name('dokter.memeriksa.show');
        Route::post('/memeriksa', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
        Route::get('/memeriksa/{id}/edit', [MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
        Route::put('/memeriksa/{id}', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
    });
});

// Route untuk profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute default untuk redirect ke login jika mengakses root
Route::get('/', function () {
    return redirect('/login');
});