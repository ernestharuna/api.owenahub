<?php

namespace App\Http\Controllers\auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminRegisterController extends Controller
{

    function register(Request $request): Response
    {
        $data = $request->validate([
            'first_name' => ['required', 'min:2', 'max:20'],
            'last_name' => ['required', 'min:2', 'max:20'],
            'email' => ['required', 'email', Rule::unique('admin', 'email')],
            'password' =>  ['required', 'confirmed', Password::min(8)->letters()->symbols()],
        ]);

        /**
         * @var Admin $admin
         */

        $admin = Admin::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $a_token = $admin->createToken('admin');

        return response([
            'admin' => $admin,
            'a_token' => $a_token->plainTextToken,
        ]);
    }
}
