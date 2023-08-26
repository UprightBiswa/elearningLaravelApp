<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::with('Classes')->get();
        return view('Admin.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all(); // Fetch classes from your model
        return view('Admin.exams.create', compact('classes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_subject' => 'required',
            'exam_date' => 'required',
            'exam_duration' => 'required|integer',
            'class_id' => 'required|exists:classes,id',
        ]);

        $examData = $request->except('_token');


        $examData['exam_date'] = Carbon::createFromFormat('d F, Y', $examData['exam_date'])->format('Y-m-d');
        Exam::create($examData);

        return redirect('admin/exams')->with('status', 'exam created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {

        return view('Admin.exams.show', compact('exam'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $exam = exam::findOrFail($id);
    $classes = Classes::all(); // Fetch classes from your model
    return view('Admin.exams.edit', compact('exam', 'classes'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_subject' => 'required',
            'exam_date' => 'required',
            'exam_duration' => 'required|integer',
            'class_id' => 'required|exists:classes,id',
        ]);

        $examData = $request->except(['_token', '_method']);

        $examData['exam_date'] = Carbon::createFromFormat('d F, Y', $examData['exam_date'])->format('Y-m-d');

        $exam = Exam::findOrFail($id);
        $exam->update($examData);

        return redirect('admin/exams')->with('status', 'Exam updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(exam $exam)
    {
        $exam->delete();

        return redirect('admin/exams')->with('status', 'exam member deleted successfully.');
    }

}


