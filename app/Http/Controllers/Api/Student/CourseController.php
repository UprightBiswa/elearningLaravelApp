<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        // Retrieve all courses from the database
        $courses = Course::all();

        // Return the courses as a JSON response
        return response()->json(['courses' => $courses], 200);
    }

    public function show($courseId)
    {
        // Retrieve a specific course based on its ID
        $course = Course::find($courseId);

        // If the course is not found, return a 404 response
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        // Return the course details as a JSON response
        return response()->json(['course' => $course], 200);
    }
}
