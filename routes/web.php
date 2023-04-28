<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.index');
    })->middleware(['auth', 'verified'])->name('Dashboard');

    Route::get('/', function () {
        return redirect()->route('Dashboard');
    });

    Route::prefix('role')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index')->name('role.index');
        Route::get('/get', 'get')->name('role.get');
        Route::get('/create', 'create')->name('role.create');
        Route::post('/store', 'store')->name('role.store');
        Route::get('/edit/{id}', 'edit')->name('role.edit');
        Route::patch('/update/{id}', 'update')->name('role.update');
        Route::delete('/delete/{id}', 'delete')->name('role.delete');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
