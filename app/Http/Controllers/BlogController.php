<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlog;
use App\Http\Requests\UpdateBlog;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Blog::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlog $request)
    {
        Blog::create($request->all());
        return response()->json([
            'resp' => true,
            'message' => 'Blog agregado correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Blog::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return response()->json([
            'resp' => true,
            'message' => 'El blog se actualizo correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json([
            'resp' => true,
            'message' => 'El blog se elimino correctamente'
        ]);
    }

}
