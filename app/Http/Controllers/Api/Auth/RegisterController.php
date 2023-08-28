<?php
namespace App\Http\Controllers\Api\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string'], // Include phone_number validation
            'address' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number, // Include phone_number in creation
            'address' => $request->address,
            'status' => 0, // Not active by default
            'role_id' => $this->getDefaultRole(),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    protected function getDefaultRole()
    {
        $defaultRole = Role::where('name', 'student')->first();

        return $defaultRole ? $defaultRole->id : null;
    }
}
