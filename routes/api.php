<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Student\ExamController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Student\ClassController;
use App\Http\Controllers\Api\Student\NotesController;
use App\Http\Controllers\Api\Student\CourseController;
use App\Http\Controllers\Api\Student\VideosController;
use App\Http\Controllers\Api\Student\StudentDashboardController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Registration and Login for Student
Route::prefix('student')->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    // Student Dashboard
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index']);
    Route::get('/students', [StudentDashboardController::class, 'getStudentsList']);
    // Courses and Subjects
    Route::get('/student/courses', [CourseController::class, 'index']);
    Route::get('/student/courses/{course}', [CourseController::class, 'show']);
    // Enroll in a course
    Route::post('/student/courses/{courseId}/enroll', [CourseController::class, 'enroll']);
    // Retrieve enrolled courses for a user
    Route::get('/student/enrolled-courses', [CourseController::class, 'enrolledCourses']);
    // Classess for  courses
    Route::get('/student/courses/{courseId}/coursesclasses', [CourseController::class,'classesForCourse']);


    // Notes
    Route::get('/student/notes', [NotesController::class, 'index']);
    Route::get('/student/notes/{note}', [NotesController::class, 'show']);
    Route::get('/student/classes/{classId}/notes', [NotesController::class, 'classNotes']);

    // Videos
    Route::get('/student/videos', [VideosController::class, 'index']);
    Route::get('/student/videos/{video}', [VideosController::class, 'show']);
    Route::get('/student/classes/{classId}/videos', [VideosController::class, 'classVideos']);

    // Exams
    Route::get('/student/exams', [ExamController::class, 'index']);
    Route::get('/student/exams/{exam}', [ExamController::class, 'show']);
    Route::get('/student/classes/{classId}/exams', [ExamController::class, 'classExams']);

    // Classes (add this route)
    Route::get('/student/classes', [ClassController::class, 'index']);
    Route::get('/student/classes/{class}', [ClassController::class, 'show']);
    Route::get('/student/courses/{courseId}/classes', [ClassController::class, 'enrolledCourseClasses']);

});
