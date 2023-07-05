<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\RequestGuard;

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
            if (Auth::guard('admin')->attempt($data, $remember)) {
                /**
                 * @var Admin $admin
                 */
                $admin = Auth::guard('admin')->user();
                $token = $admin->createToken('admin_login_token')->plainTextToken;

                return response([
                    'admin' => $admin,
                    'token' => $token,
                ]);
            }
            return response([
                'message' => 'Email or Password is incorrect'
            ], 422);
        } catch (\Exception $e) {
            return response([
                'error' => 'An error occured',
                'message' => $e->getMessage(),
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
