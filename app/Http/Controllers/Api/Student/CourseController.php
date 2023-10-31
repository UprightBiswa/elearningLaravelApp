<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Course;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function enroll(Request $request, $courseId)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Retrieve the course
        $course = Course::find($courseId);

        // Check if the course exists
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        // Enroll the user in the course
        $user->courses()->attach($course);

        return response()->json(['message' => 'Enrolled in the course'], 200);
    }
    public function enrolledCourses(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Retrieve the enrolled courses for the user
        $enrolledCourses = $user->courses;

        return response()->json(['enrolled_courses' => $enrolledCourses], 200);
    }
    public function classesForCourse($courseId)
    {
        // Retrieve the specified course
        $course = Course::find($courseId);

        // Check if the course exists
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        // Retrieve the classes for the specified course
        $classes = $course->classes;

        // Create an array to store class names
        $classNames = [];

        // Loop through each class and get the class name
        foreach ($classes as $class) {
            $classNames[] = [
                'class_name' => $class->class_name,
            ];
        }

        // Return the class names and the total number of classes for the course as a JSON response
        return response()->json(['course_classes' => $classNames, 'total_classes' => count($classes)], 200);
    }
}
