<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlog;
use App\Http\Requests\UpdateBlog;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BlogResource(Blog::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlog $request)
    {
        // Blog::create($request->all());
        // return response()->json([
        //     'resp' => true,
        //     'message' => 'Blog agregado correctamente'
        // ]);

        return (new BlogResource(Blog::create($request->all())))
                ->additional(['message' => 'Blog agregado exitosamente.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());

        return (new BlogResource($blog))
                ->additional(['message' => 'Blog actualizado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
       
        return (new BlogResource($blog))
                ->additional(['message' => 'Blog eliminado correctamente.']);
    }

}
