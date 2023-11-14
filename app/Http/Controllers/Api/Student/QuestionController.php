<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Exam;
use App\Models\AnswerOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index($examId)
    {
        $exam = Exam::findOrFail($examId);

        $questions = $exam->questions()->with('AnswerOption')->get();

        return response()->json(['questions' => $questions]);
    }
    // public function submitAnswers(Request $request, $examId)
    // {
    //     // Assuming the request contains user answers in the format ['question_id' => 'selected_option']
    //     $userAnswers = $request->all();

    //     // Calculate the total score based on correct answers
    //     $exam = Exam::findOrFail($examId);
    //     $questions = $exam->questions;

    //     $totalScore = 0;

    //     foreach ($questions as $question) {
    //         $correctOption = $question->AnswerOption->where('is_correct_option', true)->first();

    //         if ($correctOption && isset($userAnswers[$question->id]) && $userAnswers[$question->id] == $correctOption->id) {
    //             // User selected the correct option
    //             $totalScore++;
    //         }
    //     }

    //     // Save user answers to the database (optional)
    //     // You may want to save user responses in the 'user_answers' table

    //     return response()->json(['total_score' => $totalScore]);
    // }
    public function submitAnswers(Request $request, $examId)
{
    // Assuming the request contains user answers in the format ['question_id' => ['selected_option_1', 'selected_option_2', ...]]
    $userAnswers = $request->all();

    // Calculate the total score based on correct answers
    $exam = Exam::findOrFail($examId);
    $questions = $exam->questions;

    $totalScore = 0;

    foreach ($questions as $question) {
        $correctOptions = $question->AnswerOption->where('is_correct_option', 1)->pluck('id')->toArray();

        if (isset($userAnswers[$question->id])) {
            $selectedOptions = $userAnswers[$question->id];

            // Check if all correct options are selected and no incorrect option is selected
            if (count($correctOptions) == count($selectedOptions) && empty(array_diff($correctOptions, $selectedOptions))) {
                // All correct options selected
                $totalScore++;
            }
        }
    }

    // Save user answers to the database (optional)
    // You may want to save user responses in the 'user_answers' table

    return response()->json(['total_score' => $totalScore]);
}

}
