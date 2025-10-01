<?php

namespace App\Http\Controllers\Api\V1\ControlEntity;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlEntity\ControlEntityListRequest;
use App\Http\Requests\ControlEntity\ControlEntityStoreRequest;
use App\Http\Resources\ControlEntity\ControlEntityResource;
use App\Models\ControlEntity;
use App\Services\ControlEntityService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ControlEntityController extends Controller
{
    public function __construct(
        private ControlEntityService $controlEntityService
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @param ControlEntityListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection<ControlEntity>
     */
    public function index(ControlEntityListRequest $request): AnonymousResourceCollection
    {
        $response = $this->controlEntityService->list($request);

        return ControlEntityResource::collection($response);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param ControlEntityStoreRequest $request
     * @return JsonResource
     */
    public function store(ControlEntityStoreRequest  $request): JsonResource
    {
        $response = $this->controlEntityService->save($request);

        return ControlEntityResource::make($response);
    }

    /**
     * Display the specified resource.
     * 
     * @param ControlEntity $controlEntity
     * @return JsonResource
     */
    public function show(ControlEntity $controlEntity): JsonResource
    {
        $response = $this->controlEntityService->get($controlEntity);

        return ControlEntityResource::make($response);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request
     * @param ControlEntity $controlEntity
     * @return JsonResource
     */
    public function update(Request $request, ControlEntity $controlEntity): JsonResource
    {
        $response = $this->controlEntityService->update($request, $controlEntity);

        return ControlEntityResource::make($response);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param ControlEntity $controlEntity
     * @return Response
     */
    public function destroy(ControlEntity $controlEntity): Response
    {
        $controlEntity->delete();

        return response()->noContent();
    }
}
