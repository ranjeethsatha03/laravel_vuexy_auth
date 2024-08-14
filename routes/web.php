<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\SettingsController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
    Route::resource('/users', App\Http\Controllers\UserController::class);

    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::resource('/roles', App\Http\Controllers\RoleController::class);
});



require __DIR__ . '/auth.php';
