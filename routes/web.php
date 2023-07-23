<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;

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

Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/about', [HomeController::class, 'about'])->name('front.about');
Route::get('/service', [HomeController::class, 'service'])->name('front.service');
Route::get('/project', [HomeController::class, 'project'])->name('front.project');
Route::get('/contact', [HomeController::class, 'contact'])->name('front.contact');
Route::get('/team', [HomeController::class, 'team'])->name('front.team');
Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('front.testimonial');

/*Route::group(['prefix' => 'Admin'], function() {
    Route::get('/', [LoginController::class,'index'])
        ->name('admin.login');
});*/

Route::prefix('admin')->group( function () {
    //------------ ADMIN LOGIN SECTION START------------//
    Route::get('/', [LoginController::class,'index'])
    ->name('admin.login');
    Route::post('/login', [LoginController::class,'loginSubmit'])
    ->name('admin.login.submit');
    Route::get('/dashboard', [DashboardController::class,'index'])
    ->name('admin.dashboard');

    Route::resource('/users', UsersController::class)->only(
        ['index','create','store','show','edit','update','destroy']
    );
    Route::post('/users/changeStatus', [UsersController::class,'changeStatus'])
    ->name('admin.users.changestatus');

    Route::get('/logout', [DashboardController::class,'logout'])
    ->name('admin.logout');
});