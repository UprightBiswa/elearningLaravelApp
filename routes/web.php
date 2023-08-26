<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\NotesController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\VideosController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AnswerOptionController;
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
            Route::get('/staffs', 'index');
            Route::get('/staffs/create', 'create');
            Route::post('/staffs', 'store');
            Route::get('/staffs/{staff}', 'show');
            Route::get('/staffs/{staff}/edit', 'edit');
            Route::put('/staffs/{staff}', 'update');
            Route::delete('/staffs/{staff}', 'destroy');
        });
          //Student for admin
          Route::controller(StudentController::class)->group(function () {
            Route::get('/students', 'index');
            Route::get('/students/create', 'create');
            Route::post('/students', 'store');
            Route::get('/students/{student}', 'show');
            Route::get('/students/{student}/edit', 'edit');
            Route::put('/students/{student}', 'update');
            Route::delete('/students/{student}', 'destroy');
        });
          //course for admin
          Route::controller(CourseController::class)->group(function () {
            Route::get('/courses', 'index');
            Route::get('/courses/create', 'create');
            Route::post('/courses', 'store');
            Route::get('/courses/{course}', 'show');
            Route::get('/courses/{course}/edit', 'edit');
            Route::put('/courses/{course}', 'update');
            Route::delete('/courses/{course}', 'destroy');
        });
         //Classes for admin
         Route::controller(ClassController::class)->group(function () {
            Route::get('/classes', 'index');
            Route::get('/classes/create', 'create');
            Route::post('/classes', 'store');
            Route::get('/classes/{class}', 'show');
            Route::get('/classes/{class}/edit', 'edit');
            Route::put('/classes/{class}', 'update');
            Route::delete('/classes/{class}', 'destroy');
        });
        //Notes for admin
        Route::controller(NotesController::class)->group(function () {
            Route::get('/notes', 'index');
            Route::get('/notes/create', 'create');
            Route::post('/notes', 'store');
            Route::get('/notes/{note}', 'show');
            Route::get('/notes/{note}/edit', 'edit');
            Route::put('/notes/{note}', 'update');
            Route::delete('/notes/{note}', 'destroy');
        });
        //videos for admin
        Route::controller(VideosController::class)->group(function () {
            Route::get('/videos', 'index');
            Route::get('/videos/create', 'create');
            Route::post('/videos', 'store');
            Route::get('/videos/{video}', 'show');
            Route::get('/videos/{video}/edit', 'edit');
            Route::put('/videos/{video}', 'update');
            Route::delete('/videos/{video}', 'destroy');
        });
         //exams for admin
         Route::controller(ExamController::class)->group(function () {
            Route::get('/exams', 'index');
            Route::get('/exams/create', 'create');
            Route::post('/exams', 'store');
            Route::get('/exams/{exam}', 'show');
            Route::get('/exams/{exam}/edit', 'edit');
            Route::put('/exams/{exam}', 'update');
            Route::delete('/exams/{exam}', 'destroy');
        });

         //questions for admin
         Route::controller(QuestionController::class)->group(function () {
            Route::get('/questions', 'index');
            Route::get('/questions/create', 'create');
            Route::post('/questions', 'store');
            Route::get('/questions/{question}', 'show');
            Route::get('/questions/{question}/edit', 'edit');
            Route::put('/questions/{question}', 'update');
            Route::delete('/questions/{question}', 'destroy');
        });


    });

Route::prefix('student')->middleware(['auth','isStudent'])->group(function () {
        //admin dashboard route
        Route::get('/studentDashboard', [StudentDashboardController::class, 'index']);


    });
