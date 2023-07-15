<?php

namespace App\Http\Controllers\Auth\Mentors;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MentorLoginController extends Controller
{
    public function login(Request $request): Response
    {
        $remember = $request->input('remember', false);

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if (Auth::guard('mentor')->attempt($data, $remember)) {
                /**
                 * @var Mentor $mentor
                 */
                $mentor = Auth::guard('mentor')->user();
                $token = $mentor->createToken('mentor_login_token');

                return response([
                    'mentor' => $mentor,
                    'token' => $token->plainTextToken,
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
         * @var Mentor $mentor
         */

        $mentor = $request->user();
        $mentor->currentAccessToken()->delete();

        return response(null, 204);
    }
}
