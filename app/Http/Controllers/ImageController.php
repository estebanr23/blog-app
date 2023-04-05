<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);
        
        try {
            $image = $request->file('image')->store('/', 'articles');
            $url = Storage::disk('articles')->url($image);

            return response()->json([
                'res' => true,
                'image' => $url
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'res' => false,
                'message' => 'Hubo un problema al cargar la imagen.'
            ], 400);
        }

    }

}
