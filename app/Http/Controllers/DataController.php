<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Models\Data;
use Knuckles\Scribe\Attributes\UrlParam;

/**
 * @group Data
 */
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
     * Display the Timely resource.
     */
    #[UrlParam('mac_address')]
    public function showTimelyData($mac_address)
    {
        $plant = Data::query()->whereHas('plant', function ($query) use ($mac_address) {
            $query->where('mac_address', $mac_address);
        })->orderBy('time', 'desc');
        return response()->json($plant->first());
    }


    /**
     * Display the specified resource.
     */
    #[UrlParam('mac_address')]
    public function showChartData($mac_address)
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
