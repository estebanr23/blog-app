<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArea;
use App\Http\Requests\UpdateArea;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AreaResource::collection(Area::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArea $request)
    {
        // Area::create($request->all());
        // return response()->json([
        //     'resp' => true,
        //     'message' => 'Area agregada correctamente',
        // ], 200);

        return (new AreaResource(Area::create($request->all())))
                ->additional(['message' => 'Area creada exitosamente.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $area = Area::findOrFail($id);
        return new AreaResource($area);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArea $request, string $id)
    {
        $area = Area::findOrFail($id);
        $area->update([
            'name' => $request->name
        ]);

        return (new AreaResource($area))
                ->additional(['message' => 'Area actualizada exitosamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return (new AreaResource($area))
                ->additional(['message' => 'Area eliminada correctamente.']);
    }
}
