<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController; 

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
    return view('auth.login');
});

Route::get('/register', [RegisteredUserController::class, 'adduser']);

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('post', [HomeController::class, 'post']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/view_members', [AdminController::class, 'view_members']);
Route::get('/add_users', [AdminController::class, 'add_users']);
Route::get('/add_members', [AdminController::class, 'add_member']);
Route::post('/add_members', [AdminController::class, 'add_members']);
Route::get('/delete_members/{id}', [AdminController::class, 'delete_members']);
Route::get('/edit_members/{id}', [AdminController::class, 'edit_members']);
Route::put('/update_member/{id}', [AdminController::class, 'update_member']); // New route for updating members
Route::post('/store_users', [AdminController::class, 'store_users'])->name('store_users');
Route::get('/add_trainers', [AdminController::class, 'add_trainer']);
Route::post('/add_trainers', [AdminController::class, 'add_trainers']);
Route::get('/view_trainers', [AdminController::class, 'view_trainers']);
Route::get('/edit_trainers/{id}', [AdminController::class, 'edit_trainers']);
Route::put('/update_trainers/{id}', [AdminController::class, 'update_trainers']);



