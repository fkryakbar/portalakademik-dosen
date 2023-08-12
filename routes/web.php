<?php

use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth.dosen'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/', [ProfileController::class, 'update']);
    });

    Route::prefix('presensi')->group(function () {
        Route::get('/', [PresensiController::class, 'index']);
        Route::post('/', [PresensiController::class, 'store']);
        Route::get('/{kode_pertemuan}', [PresensiController::class, 'view']);
        Route::post('/{kode_pertemuan}', [PresensiController::class, 'update']);
        Route::get('/{kode_pertemuan}/hapus', [PresensiController::class, 'delete']);
    });


    Route::prefix('api')->group(function () {
        Route::get('presensi/{kode_tahun_ajaran}', [PresensiController::class, 'api_get_data']);
    });
});

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'dosen') {
            return redirect()->to('/profile');
        }
    }
    return redirect()->to('https://siamad.stitastbr.ac.id');

    // return view('welcome');
})->name('login');


Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
});
