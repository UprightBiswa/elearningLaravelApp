<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exam;
use App\Models\Question;
use App\Models\AnswerOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    // Display a list of questions
    // Modify the index function in QuestionController
    public function index()
    {
        $questions = Question::with('AnswerOption')->get(); // Retrieve questions with their answer options
        return view('admin.questions.index', compact('questions'));
    }


    // Show the form for creating a new question
    public function create()
    {
        $exams = Exam::all();
        $questions = []; // Initialize an empty array for questions
        return view('admin.questions.create', compact('exams', 'questions'));
    }



    // Store a newly created question in the database
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'questions' => 'required|array',
            'questions.*' => 'required|string',
            'options' => 'required|array',
            'options.*.text' => 'required|string',
            'correct_answers' => 'required|array',
            'correct_answers.*' => 'required|in:A,B,C,D', // Adjust validation based on your needs
        ]);


        $questionData = [
            'question_text' => $request->input('questions')[0], // Assuming only one question is added here
            'exam_id' => $request->input('exam_id'), // Use the selected exam_id
        ];

        $question = Question::create($questionData);

        $optionsData = [];
        foreach ($request->input('options') as $index => $option) {
            $optionsData[] = [
                'option_text' => $option['text'],
                'is_correct_option' => ($request->input('correct_answers')[0] == chr(65 + $index)), // Check if this option is correct
            ];
        }

        $question->AnswerOption()->createMany($optionsData);

        return redirect('admin/questions')
            ->with('success', 'Question and options created successfully.');
    }

   // Show the form for editing the specified question
   public function show(Question $question)
   {

       return view('Admin.questions.show', compact('question'));
   }
    public function edit(Question $question)
    {
        $question->load('AnswerOption'); // Load the answer options for the question
        $exams = Exam::all(); // Fetch the list of exams
        return view('admin.questions.edit', compact('question', 'exams'));
    }

    // Update the specified question and answer options in the database
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required',
            'exam_id' => 'required|exists:exams,id',
            'options' => 'required|array',
            'options.*.text' => 'required|string',
            'correct_answers' => 'required|array',
            'correct_answers.*' => 'required|in:A,B,C,D', // Adjust validation based on your needs
        ]);

        $question->update([
            'question_text' => $request->input('question_text'),
            'exam_id' => $request->input('exam_id'),
        ]);

        // Updating answer options
        foreach ($request->input('options') as $index => $option) {
            $AnswerOption = $question->AnswerOption[$index];
            $AnswerOption->update([
                'option_text' => $option['text'],
                'is_correct_option' => ($request->input('correct_answers')[$index] == chr(65 + $index)), // Check if this option is correct
            ]);
        }

        return redirect('admin/questions')
            ->with('success', 'Question and options updated successfully.');
    }

    // Remove the specified question and its answer options from the database
    public function destroy(Question $question)
    {
        $question->AnswerOption()->delete(); // Delete associated answer options
        $question->delete();

        return redirect('admin/questions')
            ->with('success', 'Question and options deleted successfully.');
    }
}
