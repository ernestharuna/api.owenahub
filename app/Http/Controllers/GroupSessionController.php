<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupSessionResource;
use App\Models\GroupSession;
use Illuminate\Http\Request;

class GroupSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GroupSessionResource::collection(
            GroupSession::with('mentor')->latest()->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'topic' => ['required', 'max:30'],
            'description' => ['required', 'max:250'],
            'meeting_link' => ['sometimes', 'nullable'],
            'max_attendants' => ['sometimes', 'nullable'],
            'date' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['sometimes', 'nullable']
        ]);

        try {
            $session = $request->user()->group_session()->create($data);
            return response(new GroupSessionResource($session), 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupSession $groupSession)
    {
        return new GroupSessionResource($groupSession);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupSession $groupSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupSession $groupSession)
    {
        $groupSession->delete();
        return response("", 204);
    }
}
