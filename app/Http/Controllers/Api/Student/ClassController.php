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

    // public function showCourseData($classId)
    // {
    //     // Retrieve the authenticated user
    //     $user = Auth::user();

    //     // Check if the class exists
    //     $classes = Classes::find($classId);

    //     if (!$classes) {
    //         return response()->json(['message' => 'Class  not found'], 404);
    //     }


    //     // Retrieve related data
    //     $classDetails = $classes->getClassDetails();

    //     return response()->json(['class_details' => $classDetails], 200);
    // }
    public function showCourseData($classId)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the class exists
        // $classes = Classes::with(['course', 'notes', 'videos', 'exams'])->find($classId);
        $classes = Classes::with(['notes', 'videos', 'exams'])->find($classId);

        if (!$classes) {
            return response()->json(['message' => 'Class not found'], 404);
        }
        // Transform the notes to include the PDF file URL
        $classes->notes->transform(function ($note) {
            return [
                'id' => $note->id,
                'note_subject' => $note->note_subject,
                'note_date' => $note->note_date,
                'note_file' => $note->getNoteFileUrlAttribute(), // Accessor for generating URL
                'class_id' => $note->class_id,
                'created_at' => $note->created_at,
                'updated_at' => $note->updated_at,
            ];
        });
        // Transform the videos to include the video file URL
        $classes->videos->transform(function ($video) {
            return [
                'id' => $video->id,
                'video_subject' => $video->video_subject,
                'video_date' => $video->video_date,
                'video_file' => $video->getVideoFileUrlAttribute(), // Accessor for generating URL
                'class_id' => $video->class_id,
                'created_at' => $video->created_at,
                'updated_at' => $video->updated_at,
            ];
        });
        // // Retrieve related data
        // $classDetails = $classes->getClassDetails();

        return response()->json(['class_details' => $classes], 200);
    }
    public function enrolledClassesForUser()
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Retrieve the enrolled courses for the user using ->get()
            $enrolledCourses = $user->courses()->get();

            // Initialize an empty array to store the enrolled classes
            $enrolledClasses = [];

            // Loop through each enrolled course and fetch the associated classes
            foreach ($enrolledCourses as $course) {
                // Check if the course has already been added
                $courseAlreadyAdded = collect($enrolledClasses)->contains('course_id', $course->id);

                // If the course has not been added, add it to the enrolledClasses array
                if (!$courseAlreadyAdded) {
                    // Retrieve the classes for the current course
                    $classes = $course->classes;

                    // Check if classes exist for the course
                    if (!$classes->isEmpty()) {
                        // Transform the classes to include additional details
                        $transformedClasses = $classes->transform(function ($class) {
                            return [
                                'id' => $class->id,
                                'class_name' => $class->class_name,
                                'class_date' => $class->class_date,
                                'class_time' => $class->class_time,
                                // Add other class details as needed
                            ];
                        });

                        // Add the transformed classes to the enrolledClasses array
                        $enrolledClasses[] = [
                            'course_id' => $course->id,
                            'course_name' => $course->course_name,
                            'classes' => $transformedClasses,
                        ];
                    }
                }
            }

            return response()->json(['enrolled_classes' => $enrolledClasses], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching enrolled classes', 'error' => $e->getMessage()], 500);
        }
    }
}
