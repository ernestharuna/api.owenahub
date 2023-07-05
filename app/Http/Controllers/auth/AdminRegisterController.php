<?php

namespace App\Http\Controllers\auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminRegisterController extends Controller
{

    function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'min:2', 'max:20'],
            'last_name' => ['required', 'min:2', 'max:20'],
            'email' => ['required', 'email', Rule::unique('admins', 'email')],
            'password' =>  ['required', 'confirmed', Password::min(8)->letters()->symbols()],
        ]);

        /**
         * @var Admin $admin
         */

        try {
            $admin = Admin::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $token = $admin->createToken('admin_token');

            return response([
                'admin' => $admin,
                'token' => $token->plainTextToken,
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);

            throw $e;
        }
    }
}
