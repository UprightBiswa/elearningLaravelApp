<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Exam;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        // Retrieve all exams from the database
        $exams = Exam::all();

        // Return the exams as a JSON response
        return response()->json(['exams' => $exams], 200);
    }

    public function show($examId)
    {
        // Retrieve a specific exam based on its ID
        $exam = Exam::find($examId);

        // If the exam is not found, return a 404 response
        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }

        // Include the questions for the exam
        $questions = $exam->questions;

        // Return the exam details along with questions as a JSON response
        return response()->json(['exam' => $exam, 'questions' => $questions], 200);
    }
    public function classExams(Request $request, $classId)
{
    // Get the authenticated user
    $user = Auth::user();

    // Retrieve the class based on the ID
    $class = Classes::find($classId);

    // Check if the class exists
    if (!$class) {
        return response()->json(['message' => 'Class not found'], 404);
    }

    // Check if the user is enrolled in the course of the class
    if (!$user->courses->contains($class->course)) {
        return response()->json(['message' => 'You are not enrolled in this course'], 403);
    }

    // Retrieve all exams for the class from the database
    $exams = $class->exams;

    // Return the exams as a JSON response
    return response()->json(['exams' => $exams], 200);
}

}
