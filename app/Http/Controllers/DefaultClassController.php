<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDefaultClassRequest;
use App\Http\Requests\UpdateDefaultClassRequest;
use App\Models\DefaultClass;

/**
 * @group DefaultClass
 */
class DefaultClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(DefaultClass::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDefaultClassRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DefaultClass $defaultClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDefaultClassRequest $request, DefaultClass $defaultClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DefaultClass $defaultClass)
    {
        //
    }
}
