<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\DefaultClassController;
use App\Http\Controllers\PlantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('plant', PlantController::class)->only('store', 'show', 'update');
Route::post('plant/status',[PlantController::class,'getPlantStatus']);

Route::controller(DataController::class)->group(function () {
    Route::get('plant/{mac_address}/data/timely', 'showTimelyData');
    Route::get('plant/{mac_address}/data/24hr', 'showChartData');
});

Route::controller(DefaultClassController::class)->group(function () {
    Route::get('default-class', 'index');
});
