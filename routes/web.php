<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
        //admin dashboard route
        Route::get('/adminDashboard', [AdminDashboardController::class, 'index']);
          //stuff for admin
          Route::controller(StaffController::class)->group(function () {
            Route::get('/stuffs', 'index');
            Route::get('/stuffs/create', 'create');
            Route::post('/stuffs', 'store');
            Route::get('/stuffs/{stuff}', 'show');
            Route::get('/stuffs/{stuff}/edit', 'edit');
            Route::put('/stuffs/{stuff}', 'update');
            Route::delete('/stuffs/{stuff}', 'destroy');
        });
    });

Route::prefix('student')->middleware(['auth','isStudent'])->group(function () {
        //admin dashboard route
        Route::get('/studentDashboard', [StudentDashboardController::class, 'index']);


    });
