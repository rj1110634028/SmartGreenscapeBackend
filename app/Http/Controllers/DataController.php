<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Models\Data;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
    #[UrlParam(name: 'mac_address', example: 'A0:B7:65:DE:0C:08')]
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
    #[UrlParam(name: 'mac_address', example: 'A0:B7:65:DE:0C:08')]
    public function showChartData($mac_address)
    {
        $start_time = Carbon::now()->subDay();
        $data = Data::query()
            ->select(
                DB::raw('year(time) as year'),
                DB::raw('month(time) as month'),
                DB::raw('day(time) as day'),
                DB::raw('hour(time) as hours'),
                DB::raw('round(avg(temperature),4) as temperature'),
                DB::raw('round(avg(humidity),4) as humidity'),
                DB::raw('round(avg(soil_humidity),4) as soil_humidity')
            )
            ->where('time', '>=', $start_time)
            ->where('mac_address', '<=', $mac_address)
            ->groupBy(
                DB::raw('year(time)'),
                DB::raw('month(time)'),
                DB::raw('day(time)'),
                DB::raw('hour(time)')
            )
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->orderBy('day', 'asc')
            ->orderBy('hours', 'asc')
            ->get();
        return response()->json($data);
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
