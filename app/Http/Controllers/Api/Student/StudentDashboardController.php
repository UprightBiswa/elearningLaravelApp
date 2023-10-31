<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.api');
    }

    public function index(Request $request)
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Return user details
            return response()->json([
                'message' => 'User details retrieved successfully',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getStudentsList()
    {
        try {
            // Retrieve students with role = 'student' from the database
            $students = User::whereHas('role', function ($query) {
                $query->where('name', 'student');
            })->get();

            return response()->json([
                'message' => 'List of students retrieved successfully',
                'students' => $students,
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
