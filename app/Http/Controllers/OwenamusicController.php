<?php

namespace App\Http\Controllers;

use App\Models\Owenamusic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OwenamusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('owenamusics', 'email')],
            'phone' => 'required',
            'learning_mode' => 'required',
            'course' => 'required',
            'for_self' => 'sometimes|nullable',
            'prior_exp' => 'sometimes|nullable',
            'package' => 'required',
        ]);

        /**
         * @var Owenamusic $user
         */

        try {
            $user = Owenamusic::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' =>  $data['phone'],
                'learning_mode' =>  $data['learning_mode'],
                'course' => $data['course'],
                'for_self' => $data['for_self'],
                'prior_exp' => $data['prior_exp'],
                'package' => $data['package'],
            ]);

            return response([
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e
            ], 500);

            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(owenamusic $owenamusic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, owenamusic $owenamusic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(owenamusic $owenamusic)
    {
        //
    }
}
