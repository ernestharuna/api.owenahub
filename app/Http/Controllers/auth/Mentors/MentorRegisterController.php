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
            'gender' => ['required'],
            'field' => ['required', 'min:2', 'max:20'],
            'exp_years' => 'required',
            'date_of_birth' => ['required', 'min:5', 'max:15'],
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
                'date_of_birth' => $data['date_of_birth'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $token = $mentor->createToken('mentor_token');

            return response([
                'mentor' => $mentor,
                'token' => $token->plainTextToken,
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e
            ], 500);

            throw $e;
        }
    }
}
