<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Course;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentClass; // Import the StudentClass model

class ClassController extends Controller
{
    public function index()
    {
        // Retrieve all classes from the database
        $classes = Classes::all();

        // Return the classes as a JSON response
        return response()->json(['classes' => $classes], 200);
    }

    public function show($classId)
    {
        // Retrieve a specific class based on its ID
        $class = Classes::find($classId);

        // If the class is not found, return a 404 response
        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        // Return the class details as a JSON response
        return response()->json(['class' => $class], 200);
    }
    public function enrolledCourseClasses(Request $request, $courseId)
{
    // Get the authenticated user
    $user = Auth::user();

    // Retrieve the enrolled course
    $course = Course::find($courseId);

    // Check if the course exists
    if (!$course) {
        return response()->json(['message' => 'Course not found'], 404);
    }

    // Check if the user is enrolled in the course
    if (!$user->courses->contains($course)) {
        return response()->json(['message' => 'You are not enrolled in this course'], 403);
    }

    // Retrieve the classes for the enrolled course
    $classes = $course->classes;

    if ($classes->isEmpty()) {
        return response()->json(['message' => 'No classes found for this course'], 404);
    }

    return response()->json(['enrolled_course_classes' => $classes], 200);
}

}
