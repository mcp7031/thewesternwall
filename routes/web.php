<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AocController;
use App\Http\Controllers\InventoryController;
use Inertia\Inertia;

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

require base_path('bootstrap.php');

Route::get('/', [MessageController::class, 'index']);
// Route::get('/posts', [MessageController::class, 'show']);
// Route::resource('posts', TelegramUpdateController::class);

// dd([$_GET, $_SERVER, $_POST]);

Route::resource('posts', MessageController::class);
Route::resource('aoc', AocController::class);
Route::resource('inventory', InventoryController::class);
Route::get('/invedit', [InventoryController::class, 'edit']);
Route::patch('/invedit', [InventoryController::class, 'store']);
Route::get('/invariant', [InventoryController::class, 'create']);
Route::post('/invariant', [InventoryController::class, 'store']);
Route::post('/aoc', [AocController::class, 'store']);
Route::get('/edit', [AocController::class, 'edit']);
Route::patch('/edit', [AocController::class, 'store']);
Route::post('/subscribe', [UserController::class, 'store']);
Route::get('/subscribe', [UserController::class, 'subscribe']);
Route::get('/register', [UserController::class, 'subscribe']);
Route::get('/about', [UserController::class, 'about']);
Route::get('/aboutRTV', [UserController::class, 'aboutRTV']);
Route::get('/whatwebelieve', [UserController::class, 'whatwebelieve']);
Route::get('/login', [UserController::class, 'create']);
Route::post('/login', [UserController::class, 'store']);
//Route::post('/login', [UserController::class, 'store'])->only('guest');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
