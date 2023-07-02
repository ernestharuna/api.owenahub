<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    function login(Request $request): Response
    {
        $remember = $request->input('remember', false);

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if (Auth::attempt($data, $remember)) {
                /**
                 * @var Admin $admin
                 */
                $admin = Auth::user();
                $a_token = $admin->createToken('admin');

                return response([
                    'admin' => $admin,
                    'a_token' => $a_token->plainTextToken,
                ]);
            }
            return response([
                'message' => 'Email or Password is incorrect'
            ], 422);
        } catch (\Exception $e) {
            return response([
                'error' => 'An error occured',
            ], 500);
        }
    }

    // logout function
    function logout(Request $request): Response
    {
        /**
         * @var Admin $admin
         */

        $admin = $request->user();
        $admin->currentAccessToken()->delete();

        return response(null, 204);
    }
}
