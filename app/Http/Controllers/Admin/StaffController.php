<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve staff members with role = 'admin' from the database
        $staffMembers = User::whereHas('role', function ($query) {
            $query->where('name', 'admin');
        })->get();
        return view('Admin.staffs.index', compact('staffMembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.staffs.create');
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
            // 'role_id' => 'required',
        ]);

        // Create a new staff member
        $users = new user();
        $users->name = $validatedData['name'];
        $users->email = $validatedData['email'];
        $users->password = Hash::make($validatedData['password']);
        $users->phone_number = $validatedData['phone_number'];
        $users->address = $validatedData['address'];
        $users->role_id = Role::where('name', 'admin')->first()->id;
        $users->status = $validatedData['status'];
        $users->save();

        return redirect('admin/staffs')->with('status', 'Staff member created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $staff)
    {

        return view('Admin.staffs.show', compact('staff'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff)
    {
        return view('Admin.staffs.edit', compact('staff'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $staff)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($staff->id)],
            'phone_number' => 'required',
            'password' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1',
        ]);

        $staff->name = $validatedData['name'];
        $staff->email = $validatedData['email'];
        $staff->phone_number = $validatedData['phone_number'];
        $staff->password = $validatedData['password'];
        $staff->address = $validatedData['address'];
        $staff->status = $validatedData['status'];
        $staff->save();

        return redirect('admin/staffs')->with('status', 'Staff member updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
