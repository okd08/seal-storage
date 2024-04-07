<?php

// コントローラー
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SealController;
// 機能
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome2');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // sealコントローラー
    Route::resource('seals', SealController::class);
});

require __DIR__.'/auth.php';