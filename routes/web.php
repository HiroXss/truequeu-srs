<?php

use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::get('/publicaciones/{id}', [PublicacionController::class, 'show'])->name('publicaciones.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/publicaciones/{publicacion}/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');
});

require __DIR__.'/auth.php';
