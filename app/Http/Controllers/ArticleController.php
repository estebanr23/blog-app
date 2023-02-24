<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Http\Requests\UpdateArticle;
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
        return new ArticleResource(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticle $request)
    {
        // Article::create($request->all());
        // return response()->json([
        //     'resp' => true,
        //     'message' => 'Article agregado correctamente'
        // ]);

        return (new ArticleResource(Article::create($request->all())))
                ->additional(['message' => 'Article agregado exitosamente.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return (new ArticleResource($article))
                ->additional(['message' => 'Article actualizado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
       
        return (new ArticleResource($article))
                ->additional(['message' => 'Article eliminado correctamente.']);
    }

}
