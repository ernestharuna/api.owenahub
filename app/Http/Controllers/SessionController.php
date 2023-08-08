<?php

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SessionResource::collection(Session::with('mentor', 'user')->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:250'],
            'mentor_id' => ['required']
        ]);

        try {
            $session = $request->user()->session()->create($data);

            $code = Str::random(8);
            while (Session::where('session_code', $code)->exists()) {
                $code = Str::random(8);
            }
            $session->session_code = $code;
            $session->save();

            return response(new SessionResource($session), 200);
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
    public function show(Session $session)
    {
        return new SessionResource($session);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return response("", 204);
    }
}
