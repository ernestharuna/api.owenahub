<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'min:2', 'max:20'],
            'last_name' => ['required', 'min:2', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            // 'gender' => 'required',
            // 'date_of_birth' => 'required|date',
            'password' =>  ['required', 'confirmed', Password::min(8)->letters()->symbols()],
        ]);

        /**
         * @var User $user
         */
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            // 'gender' => $data['gender'],
            // 'date_of_birth' => $data['date_of_birth'],
            'password' => Hash::make($data['password'])
        ]);

        $token = $user->createToken('user')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
}
