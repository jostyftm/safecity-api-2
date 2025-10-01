<?php

namespace App\Http\Controllers\Api\V1\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\CityListRequest;
use App\Http\Requests\City\CityStoreRequest;
use App\Http\Requests\City\CityUpdateRequest;
use App\Http\Resources\City\CityResource;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CityController extends Controller
{

    public function __construct(
        private CityService $cityService
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @param CityListRequest $request
     * @return AnonymousResourceCollection<CityResource>
     */
    public function index(CityListRequest $request): AnonymousResourceCollection
    {
        $cities = $this->cityService->list($request);

        return CityResource::collection($cities);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param CityStoreRequest $request
     * @return JsonResource
     */
    public function store(CityStoreRequest $request): JsonResource
    {
        $city = $this->cityService->save($request);

        return CityResource::make($city);
    }

    /**
     * Display the specified resource.
     * 
     * @param City $city
     * @return JsonResource
     */
    public function show(City $city): JsonResource
    {
        return CityResource::make($city);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param CityUpdateRequest $request
     * @param City $city
     * @return JsonResource
     */
    public function update(CityUpdateRequest $request, City $city): JsonResource
    {
        $city = $this->cityService->update($request, $city);

        return CityResource::make($city);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city): Response
    {
        $city = $this->cityService->delete($city);

        return response()->noContent();
    }
}
