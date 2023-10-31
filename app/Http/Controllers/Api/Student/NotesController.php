<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Note; // Import the Note model

class NotesController extends Controller
{
    public function index()
    {
        // Retrieve all notes from the database
        $notes = Note::all();

        // Return the notes as a JSON response
        return response()->json(['notes' => $notes], 200);
    }

    public function show($noteId)
    {
        // Retrieve a specific note based on its ID
        $note = Note::find($noteId);

        // If the note is not found, return a 404 response
        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        // Return the note details as a JSON response
        return response()->json(['note' => $note], 200);
    }
    // NotesController
public function classNotes(Request $request, $classId)
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

    // Retrieve all notes for the class from the database
    $notes = $class->notes;

    // Return the notes as a JSON response
    return response()->json(['notes' => $notes], 200);
}
}
