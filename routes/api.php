<?php

use App\Http\Controllers\DataController;
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

Route::controller(PlantController::class)->group(function () {
    Route::post('plant', 'store');
    Route::put('plant/{plant}', 'update');
});

Route::controller(DataController::class)->group(function () {
    Route::get('data/{mac_address}/now', 'showTimelyData');
    Route::get('data/{mac_address}/24hr', 'showChart');
});
