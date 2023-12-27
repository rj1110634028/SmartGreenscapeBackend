<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Models\Data;

class DataController extends Controller
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
    public function store(StoreDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($mac_address)
    {
        $plant = Data::query()->whereHas('plant', function ($query) use ($mac_address) {
            $query->where('mac_address', $mac_address);
        })->orderBy('time', 'desc');
        return response()->json($plant->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDataRequest $request, Data $data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Data $data)
    {
        //
    }
}
