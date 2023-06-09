<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve students members with role = 'student' from the database
        $studentsMembers = User::whereHas('role', function ($query) {
            $query->where('name', 'student');
        })->get();
        return view('Admin.students.index', compact('studentsMembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.students.create');
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1',

        ]);

        // Create a new students member
        $users = new user();
        $users->name = $validatedData['name'];
        $users->email = $validatedData['email'];
        $users->password = Hash::make($validatedData['password']);
        $users->phone_number = $validatedData['phone_number'];
        $users->address = $validatedData['address'];
        $users->role_id = Role::where('name', 'student')->first()->id;
        $users->status = $validatedData['status'];
        $users->save();

        return redirect('admin/students')->with('status', 'students member created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {

        return view('Admin.students.show', compact('student'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        return view('Admin.students.edit', compact('student'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $student)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($student->id)],
            'phone_number' => 'required',
            'password' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1',
        ]);

        $student->name = $validatedData['name'];
        $student->email = $validatedData['email'];
        $student->phone_number = $validatedData['phone_number'];
        $student->password =Hash::make($validatedData['password']);
        $student->address = $validatedData['address'];
        $student->status = $validatedData['status'];
        $student->save();

        return redirect('admin/students')->with('status', 'students member updated successfully.');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        $student->delete();

        return redirect('admin/students')->with('status', 'students member deleted successfully.');
    }

}
