<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\UserController; 
use App\Http\Controllers\Backend\TrainerController; 
use App\Http\Controllers\Backend\MemberController; 
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

Route::get('/view_members', [MemberController::class, 'view_members']);
Route::get('/add_members', [MemberController::class, 'add_member']);
Route::post('/add_members', [MemberController::class, 'add_members']);
Route::get('/delete_members/{id}', [MemberController::class, 'delete_members']);
Route::get('/edit_members/{id}', [MemberController::class, 'edit_members']);
Route::put('/update_member/{id}', [MemberController::class, 'update_member']); // New route for updating members


Route::get('/add_users', [UserController::class, 'add_users']);
Route::post('/store_users', [UserController::class, 'store_users'])->name('store_users');
Route::get('/view_users', [UserController::class, 'view_users']);
Route::get('/edit_users/{id}', [UserController::class, 'edit_users']);
Route::put('/update_users/{id}', [UserController::class, 'update_users']);
Route::get('/delete_users/{id}', [UserController::class, 'delete_users']);



Route::get('/add_trainers', [TrainerController::class, 'index']);
Route::post('/add_trainers', [TrainerController::class, 'add_trainers']);
Route::get('/view_trainers', [TrainerController::class, 'view_trainers']);
Route::get('/edit_trainers/{id}', [TrainerController::class, 'edit_trainers']);
Route::put('/update_trainers/{id}', [TrainerController::class, 'update_trainers']);
Route::get('/delete_trainers/{id}', [TrainerController::class, 'delete_trainers']);




