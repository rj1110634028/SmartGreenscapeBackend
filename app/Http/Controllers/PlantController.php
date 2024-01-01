<?php

namespace App\Http\Controllers;

use App\Http\Requests\getPlantStatusRequest;
use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use App\Models\Plant;
use Illuminate\Support\Facades\DB;
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

    /**
     * Check Plant Status.
     */
    public function getPlantStatus(getPlantStatusRequest $request)
    {
        $data = $request->validated();
        $results = DB::table('data as d')
            ->select(
                'd.mac_address',
                DB::raw('d.temperature < p.min_temperature as is_temperature_low'),
                DB::raw('d.temperature > p.max_temperature as is_temperature_high'),
                DB::raw('d.humidity < p.min_humidity as is_humidity_low'),
                DB::raw('d.humidity > p.max_humidity as is_humidity_high'),
                DB::raw('d.soil_humidity < p.min_soil_humidity as is_soil_humidity_low'),
                DB::raw('d.soil_humidity > p.max_soil_humidity as is_soil_humidity_high'),
                'd.time',
            )
            ->join(DB::raw('(SELECT mac_address, MAX(time) AS max_time FROM data GROUP BY mac_address) AS latest'), function ($join) {
                $join->on('d.mac_address', '=', 'latest.mac_address');
                $join->on('d.time', '=', 'latest.max_time');
            })
            ->join('plants as p', 'd.mac_address', '=', 'p.mac_address')
            ->where(function ($query) {
                $query->where('d.temperature', '<', DB::raw('p.min_temperature'))
                    ->orWhere('d.temperature', '>', DB::raw('p.max_temperature'))
                    ->orWhere('d.humidity', '<', DB::raw('p.min_humidity'))
                    ->orWhere('d.humidity', '>', DB::raw('p.max_humidity'))
                    ->orWhere('d.soil_humidity', '<', DB::raw('p.min_soil_humidity'))
                    ->orWhere('d.soil_humidity', '>', DB::raw('p.max_soil_humidity'));
            })
            ->whereIn('d.mac_address', $data['mac_addresses'])
            ->where('p.is_want_remind', true)
            ->get()->toArray();
        $res = [];
        foreach ($results as $key => $result) {
            array_push($res, ['mac_address' => $result->mac_address, 'messagges' => []]);
            if ($result->is_temperature_low) {
                array_push($res[$key]['messagges'], "當前溫度小於設定最小溫度");
            }
            if ($result->is_temperature_high) {
                array_push($res[$key]['messagges'], "當前溫度大於設定最大溫度");
            }
            if ($result->is_humidity_low) {
                array_push($res[$key]['messagges'], "當前濕度小於設定最小濕度");
            }
            if ($result->is_humidity_high) {
                array_push($res[$key]['messagges'], "當前濕度大於設定最大濕度");
            }
            if ($result->is_soil_humidity_low) {
                array_push($res[$key]['messagges'], "當前土壤濕度小於設定最小土壤濕度");
            }
            if ($result->is_soil_humidity_high) {
                array_push($res[$key]['messagges'], "當前土壤濕度大於設定最大土壤濕度");
            }
        }
        return response()->json($res);
    }
}
