<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
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

    public function articlesFromArea($area)
    {
        return new ArticleResource(Article::where('area_id', $area)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Article::create($request->all());
        // return response()->json([
        //     'resp' =>  $request->content,
        //     'message' => 'Article agregado correctamente'
        // ]);

        return (new ArticleResource(Article::create([
            'title' => 'Titulo de articulo fijo',
            'content' => $request->content,
            'images' => 'nombre de imagen',
            'area_id' => 5,
            'user_id' => 1
        ])))->additional(['message' => 'Article agregado exitosamente.']);
    }

    /* public function storeImage(Request $request)
    {
        $path = $request->image->store('public/articles');

        return (new ArticleResource(Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $path,
            'area_id' => $request->area_id,
            'user_id' => $request->user_id
        ])))->additional(['message' => 'Article agregado exitosamente.']);
    } */

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
