<?php

namespace App\Http\Controllers\Auth\Mentors;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class MentorRegisterController extends Controller
{
    public function register(Request $request): Response
    {
        $data = $request->validate([
            'first_name' => ['required', 'min:2', 'max:20'],
            'last_name' => ['required', 'min:2', 'max:20'],
            'gender' => ['required', 'max:7'],
            'field' => ['required', 'min:2', 'max:20'],
            'exp_years' => ['required'],
            'email' => ['required', 'email', Rule::unique('mentors', 'email')],
            'password' =>  ['required', 'confirmed', Password::min(8)->letters()->symbols()],
        ]);

        /**
         * @var Mentor $mentor
         */
        try {
            $mentor = Mentor::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'field' => $data['field'],
                'exp_years' => $data['exp_years'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $token = $mentor->createToken('mentor_token');

            return response([
                'mentor' => $mentor,
                'token' => $token->plainTextToken,
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e
            ], 500);

            throw $e;
        }
    }
}
