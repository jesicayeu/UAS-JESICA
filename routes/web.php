<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [WisataController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/wisatas/store', [WisataController::class, 'store'])->name('wisatas.store');
    Route::put('/dashboard/wisatas/{wisata}', [WisataController::class, 'update'])->name('wisatas.update'); // Define the update route
    Route::delete('/dashboard/wisatas/{wisata}', [WisataController::class, 'destroy'])->name('wisatas.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
