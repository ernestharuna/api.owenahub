<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ArticleResource::collection(
            Article::with('admin', 'user')->latest()->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:5', 'max:100'],
            'description' => ['required', 'min:10', 'max:150'],
            'content' => 'required',
            'published' => 'sometimes|nullable',
            'category' => 'required'
        ]);

        try {
            $article = $request->user()->article()->create($data);
            return response(new ArticleResource($article), 200);
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
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => ['required', 'min:5', 'max:100'],
            'description' => ['required', 'min:10', 'max:150'],
            'content' => 'required',
            'published' => 'sometimes|nullable',
            'category' => 'required'
        ]);
        $article->update($data);

        return response([
            'article' => $data,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response("", 204);
    }
}
