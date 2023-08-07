<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $remember = $request->input('remember', false);

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if (Auth::attempt($data, $remember)) {
                /**
                 * @var User $user
                 */
                $user = Auth::user();
                $token = $user->createToken('user');

                return response([
                    'user' => $user,
                    'token' => $token->plainTextToken,
                ]);
            }
            return response([
                'message' => 'Email or Password is incorrect'
            ], 422);
        } catch (\Exception $e) {
            return response([
                'error' => 'An error occurred while processing the request',
                'message' => $e
            ], 500);
        }
    }


    public function logout(Request $request): Response
    {
        /**
         * @var User $user
         */

        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response(null, 204);
    }
}
