<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use App\Models\Plant;
use Knuckles\Scribe\Attributes\UrlParam;


/**
 * @group Plant
 */
class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request)
    {
        $data = $request->validated();
        $plant = Plant::create($data);
        return response()->json($plant);
    }

    /**
     * Display the specified resource.
     */
    #[UrlParam(name: 'mac_address', example: 'A0:B7:65:DE:0C:08')]
    public function show(Plant $plant)
    {
        return response()->json($plant);
    }

    /**
     * Update the specified resource in storage.
     */
    #[UrlParam(name: 'mac_address', example: 'A0:B7:65:DE:0C:08')]
    public function update(UpdatePlantRequest $request, Plant $plant)
    {
        $data = $request->validated();
        $plant->update($data);
        return response()->json($plant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        //
    }
}
