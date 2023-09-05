<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WaitlistController extends Controller
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
            'interest' => 'sometimes|nullable',
            'email' => ['required', 'email', Rule::unique('waitlists', 'email')],
        ]);

        $data['interest'] = $data['interest'] ?? 'Newsletter';

        /**
         * @var Waitlist $user
         */

        try {
            $user = Waitlist::create([
                'name' => $data['name'],
                'interest' => $data['interest'],
                'email' => $data['email']
            ]);

            return response([
                'user' => $user,
                'message' => $user['email'] . " has been added to the waitlist",
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
    public function show(Waitlist $waitlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Waitlist $waitlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Waitlist $waitlist)
    {
        //
    }
}
