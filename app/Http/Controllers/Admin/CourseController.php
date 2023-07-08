<?php
namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        return view('Admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_name' => 'required',
            'course_description' => 'required',
            'course_code' => 'required',
            'course_price' => 'required|numeric',
            'course_duration' => 'required',
            'start_from' => 'required',
        ]);
        $validatedData['start_from'] = Carbon::createFromFormat('d F, Y', $validatedData['start_from'])->format('Y-m-d');

        // dd($request->all());
        Course::create($validatedData);

        return redirect('admin/courses')->with('status', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('Admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('Admin.courses.edit', compact('course'));
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
        'course_name' => 'required',
        'course_description' => 'required',
        'course_code' => 'required',
        'course_price' => 'required|numeric',
        'course_duration' => 'required',
        'start_from' => 'required',
    ]);

    $validatedData['start_from'] = Carbon::createFromFormat('d F, Y', $validatedData['start_from'])->format('Y-m-d');

    $course = Course::findOrFail($id);
    $course->update($validatedData);

    return redirect('admin/courses')->with('status', 'Course updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect('admin/courses')->with('status', 'Course deleted successfully.');
    }
}
