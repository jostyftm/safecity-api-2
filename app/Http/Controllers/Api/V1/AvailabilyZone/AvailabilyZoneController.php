<?php

namespace App\Http\Controllers\Api\V1\AvailabilyZone;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailabilyZone\AvailabilyZoneListRequest;
use App\Http\Requests\AvailabilyZone\AvailabilyZoneStoreRequest;
use App\Http\Requests\AvailabilyZone\AvailabilyZoneUpdateRequest;
use App\Models\AvailabilyZone;
use App\Models\ControlEntity;
use Illuminate\Http\Request;

class AvailabilyZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AvailabilyZoneListRequest $request, ControlEntity $controlEntity)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvailabilyZoneStoreRequest $request, ControlEntity $controlEntity)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AvailabilyZone $availabilyZone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvailabilyZoneUpdateRequest $request, AvailabilyZone $availabilyZone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvailabilyZone $availabilyZone)
    {
        //
    }
}
