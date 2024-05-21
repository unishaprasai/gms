<?php

use App\Http\Controllers\backend\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\UserController; 
use App\Http\Controllers\Backend\TrainerController; 
use App\Http\Controllers\Backend\MemberController; 
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\backend\ClassController;
use App\Http\Controllers\backend\PackageController;
use App\Http\Controllers\backend\AnnouncementController;
use App\Http\Controllers\backend\EnrollmentController;
use App\Http\Controllers\backend\TrainerAttendanceController;

use App\Http\Controllers\backend\NotificationController;
use App\Http\Controllers\backend\PlanController;
use App\Http\Controllers\backend\StudentAttendanceController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\BMIController;
use App\Http\Controllers\Frontend\ClassTimeController;
use App\Http\Controllers\Frontend\ContactController ;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\TeamController;
use App\Http\Controllers\Frontend\ProfileEditController;




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


Route::get('/view_members', [MemberController::class, 'view_members'])->middleware('auth');
Route::get('/add_members', [MemberController::class, 'add_member']);
Route::post('/add_members', [MemberController::class, 'add_members']);
Route::get('/delete_members/{id}', [MemberController::class, 'delete_members']);
Route::get('/edit_members/{id}', [MemberController::class, 'edit_members']);
Route::put('/update_member/{id}', [MemberController::class, 'update_member']); 


Route::get('/add_users', [UserController::class, 'add_users'])->middleware('isAdmin');
Route::post('/store_users', [UserController::class, 'store_users'])->name('store_users')->middleware('isAdmin');
Route::get('/view_users', [UserController::class, 'view_users']);
Route::get('/edit_users/{id}', [UserController::class, 'edit_users'])->middleware('isAdmin');
Route::put('/update_users/{id}', [UserController::class, 'update_users'])->middleware('isAdmin');
Route::get('/delete_users/{id}', [UserController::class, 'delete_users'])->middleware('isAdmin');



Route::get('/add_trainers', [TrainerController::class, 'index']);
Route::post('/add_trainers', [TrainerController::class, 'add_trainers']);
Route::get('/view_trainers', [TrainerController::class, 'view_trainers']);
Route::get('/edit_trainers/{id}', [TrainerController::class, 'edit_trainers']);
Route::put('/update_trainers/{id}', [TrainerController::class, 'update_trainers']);
Route::get('/delete_trainers/{id}', [TrainerController::class, 'delete_trainers']);




Route::get('/add_classes', [ClassController::class, 'index']);
Route::post('/add_class', [ClassController::class, 'addClass']);
Route::get('/view_class', [classController::class, 'view_class']);
Route::get('/edit_class/{id}', [ClassController::class, 'edit_class']);
Route::put('/update_class/{id}', [ClassController::class, 'update_class']);
Route::get('/delete_class/{id}', [ClassController::class, 'delete_class']);



Route::get('/add_packages', [PackageController::class, 'index']);
Route::post('/add_package', [PackageController::class, 'add_package']);
Route::get('/view_package', [PackageController::class, 'view_package']);
Route::get('/edit_package/{package_id}', [PackageController::class, 'edit_package']);
Route::put('/update_package/{package_id}', [PackageController::class, 'update_package']);
Route::get('/delete_package/{package_id}', [PackageController::class, 'delete_package']);






 Route::get('/attendance_sheet', [TrainerAttendanceController::class, 'index'])->name('backend.attendance');
 Route::post('/save', [TrainerAttendanceController::class, 'checkIn']);
 Route::get('/view_trainers_att', [TrainerAttendanceController::class, 'view_index']);
 Route::get('/delete_trainer_att/{id}', [TrainerAttendanceController::class, 'delete']);
 Route::post('/manual_entry', [TrainerAttendanceController::class, 'manual']);

 



Route::get('/add_ann', [AnnouncementController::class, 'index']);
Route::post('/add_announcement', [AnnouncementController::class, 'store']);
Route::get('/view_announcement', [AnnouncementController::class, 'view']);
Route::get('/delete_announcement/{id}', [AnnouncementController::class, 'delete']);



// Route::get('/add_announcement', [NotificationController::class, 'index']);
Route::post('/notifications/markAllAsRead', 'NotificationController@markAllAsRead')->name('notifications.markAllAsRead');
Route::get('/view_noti', [NotificationController::class, 'view']);

Route::get('/add_plan', [PlanController::class, 'index']);
Route::post('/add_plans', [PlanController::class, 'store']);
Route::get('/view_announcement', [AnnouncementController::class, 'view']);
Route::get('/delete_announcement/{id}', [AnnouncementController::class, 'delete']);



Route::post('/khalti/payment/verify',[PaymentController::class,'verifyPayment'])->name('khalti.verifyPayment');

Route::post('/khalti/payment/store',[PaymentController::class,'storePayment'])->name('khalti.storePayment');


Route::post('/enrollments', [EnrollmentController::class, 'store']);
Route::get('/view_enrollments', [EnrollmentController::class, 'view']);

// Route::post('/update_enrollment_status', [EnrollmentController::class,'updateStatus']);
Route::post('/update_enrollment_status/{enrollment}', [EnrollmentController::class, 'updateStatus'])->name('update_enrollment_status');







//Member
Route::get('/user',[UserDashboardController::class,'index']);
Route::get('/about',[AboutUsController::class,'index']);
Route::get('bmicalculator',[BMIController::class,'index']);
Route::get('/classtime',[ClassTimeController::class,'index']);
Route::get('/services',[ServiceController::class,'index']);
Route::get('/team',[TeamController::class,'index']);



Route::get('/contact',[ContactController::class,'index']);
Route::post('/submit', [ContactController::class, 'store']);

Route::get('/profile_edit',[ProfileEditController::class,'index']);

Route::get('/attendance', [StudentAttendanceController::class, 'index']);
Route::post('/update_att', [StudentAttendanceController::class, 'checkIn']);
Route::get('/delete_mem_att/{id}', [StudentAttendanceController::class, 'delete']);
Route::get('/view_members_att', [StudentAttendanceController::class, 'view_index']);
Route::post('/manual', [StudentAttendanceController::class, 'manual']);




 





Route::middleware('isAdmin')->group(function(){
    
});