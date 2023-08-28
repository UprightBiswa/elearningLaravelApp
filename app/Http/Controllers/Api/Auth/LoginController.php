<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->status == 0) {
                return response()->json(['message' => 'Wait for admin approval.'], 403);
            }

            // Check if the user's role is Student (role_id 2)
            if ($user->role_id == 2) {
                $token = $user->createToken('API Token')->accessToken;

                $message = 'Login successful';

                return response()->json([
                    'message' => $message,
                    'token' => $token,
                ], 200);
            } else {
                // If the user is not a student, return a forbidden response
                return response()->json(['message' => 'Access denied.'], 403);
            }
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }


    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
}
