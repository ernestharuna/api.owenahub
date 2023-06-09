<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {
            /**
             * @var User $user
             */
            $user = Auth::user();
            $token = $user->createToken('main')->plainTextToken;

            return response([
                'user' => $user,
                'token' => $token
            ]);
        }

        return response([
            'message' => 'Email or Password is incorrect'
        ], 422);
    }

    public function logout(Request $request)
    {
        /**
         * @var User $user
         */

        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response('', 204);
    }
}
