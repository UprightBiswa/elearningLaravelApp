<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::with('course')->get();

        return view('Admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all(); // Fetch all courses from the database

         return view('Admin.classes.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'class_name' => 'required',
            'class_date' => 'required',
            'class_time' => 'required',
            'course_id' => 'required',
        ]);

        $validatedData['class_date'] = Carbon::createFromFormat('d F, Y', $validatedData['class_date'])->format('Y-m-d');
        $validatedData['class_time'] = Carbon::createFromFormat('H:i', $validatedData['class_time'])->format('H:i:s');

        Classes::create($validatedData);

        return redirect('admin/classes')->with('status', 'Class created successfully.');
    } catch (\Exception $e) {
        // Log or dump the error message for diagnosis
        dd($e->getMessage());
    }
}




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        return view('Admin.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        $courses = Course::all();
        return view('Admin.classes.edit', compact('class','courses'));
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
    $validatedData = $request->validate([
        'class_name' => 'required',
        'class_date' => 'required',
        'class_time' => 'required',
        'course_id' => 'required',
    ]);

    $validatedData['class_date'] = Carbon::createFromFormat('d-m-y', $validatedData['class_date'])->format('Y-m-d');

    $validatedData['class_time'] = Carbon::createFromFormat('H:i', $validatedData['class_time'])->format('H:i:s');

    $class = Classes::findOrFail($id);
    $class->update($validatedData);

    return redirect('admin/classes')->with('status', 'class updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect('admin/classes')->with('status', 'class deleted successfully.');
    }
}
