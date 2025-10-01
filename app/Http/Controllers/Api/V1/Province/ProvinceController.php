<?php

namespace App\Http\Controllers\Api\V1\Province;

use App\Http\Controllers\Controller;
use App\Http\Requests\Province\ProvinceListRequest;
use App\Http\Requests\Province\ProvinceStoreRequest;
use App\Http\Requests\Province\ProvinceupdateRequest;
use App\Http\Resources\Province\ProvinceResource;
use App\Models\Province;
use App\Services\ProvinceService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ProvinceController extends Controller
{
    public function __construct(
        private ProvinceService $provinceService
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @param ProvinceListRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(ProvinceListRequest $request): AnonymousResourceCollection
    {
        $provinces = $this->provinceService->list($request);

        return ProvinceResource::collection($provinces);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param ProvinceStoreRequest $request
     * @return JsonResource
     */
    public function store(ProvinceStoreRequest $request): JsonResource
    {
        $province = $this->provinceService->save($request);

        return ProvinceResource::make($province);
    }

    /**
     * Display the specified resource.
     * 
     * @param Province $province
     * @return JsonResource 
     */
    public function show(Province $province): JsonResource
    {
        $province = $this->provinceService->get($province);

        return ProvinceResource::make($province);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request
     * @param Province $province
     * @return JsonResource
     */
    public function update(ProvinceupdateRequest $request, Province $province): JsonResource
    {
        $province = $this->provinceService->update($request, $province);

        return ProvinceResource::make($province);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Province $province
     * @return Response
     */
    public function destroy(Province $province): Response
    {
        $this->provinceService->delete($province);

        return response()->noContent();
    }
}
