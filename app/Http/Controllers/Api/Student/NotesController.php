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
        // Transform the notes to include the PDF file URL
        $notes->transform(function ($note) {
            return $this->transformNote($note);
        });

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
        // Transform the note to include the PDF file URL
        $transformedNote = $this->transformNote($note);

        // Return the note details as a JSON response
        return response()->json(['note' => $transformedNote], 200);
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
        // Transform the notes to include the PDF file URL
        $notes->transform(function ($note) {
            return [
                'id' => $note->id,
                'note_subject' => $note->note_subject,
                'note_date' => $note->note_date,
                'note_file' => $note->getNoteFileUrlAttribute(), // Update with your accessor
                'class_id' => $note->class_id,
                'created_at' => $note->created_at,
                'updated_at' => $note->updated_at,
            ];
        });

        // Return the notes as a JSON response
        return response()->json(['notes' => $notes], 200);
    }
    protected function transformNote($note)
    {
        return [
            'id' => $note->id,
            'note_subject' => $note->note_subject,
            'note_date' => $note->note_date,
            'note_file' => $note->getNoteFileUrlAttribute(), // Update with your accessor
            'class_id' => $note->class_id,
            'created_at' => $note->created_at,
            'updated_at' => $note->updated_at,
        ];
    }
}
