<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(
            User::with('articles', 'sessions', 'education')->get()
        );
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, Article $article)
    {
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return response("", 204);
    }
}
