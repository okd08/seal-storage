<?php

// コントローラー
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SealController;
// 機能
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
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
    Route::post('/seals.create', [SealController::class, 'store2'])
        ->name('seals.store2');
    Route::get('/packages/index', [SealController::class, 'index2'])
        ->name('packages.index');
    Route::get('/packages/edit/{id}', [SealController::class, 'edit2'])
        ->name('packages.edit');
    Route::patch('/packages/update/{id}', [SealController::class, 'update2'])
        ->name('packages.update');
    Route::delete('/packages/{id}', [SealController::class, 'destroy2'])
        ->name('packages.destroy');
    Route::patch('/seals.favorite/{id}', [SealController::class, 'favorite'])
        ->name('seals.favorite');
});

require __DIR__.'/auth.php';