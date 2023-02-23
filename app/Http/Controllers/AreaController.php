<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArea;
use App\Http\Requests\UpdateArea;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Area::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArea $request)
    {
        Area::create($request->all());

        return response()->json([
            'resp' => true,
            'message' => 'Area agregada correctamente',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Area::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArea $request, string $id)
    {
        $area = Area::find($id);
        $area->update([
            'name' => $request->name
        ]);

        return response()->json([
            'resp' => true,
            'message' => 'Area actualizada correctamente',
        ], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $area = Area::find($id);
        $area->delete();

        return response()->json([
            'resp' => true,
            'message' => 'Area eliminada correctamente',
        ], 200);
    }
}
