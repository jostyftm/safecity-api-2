<?php

namespace App\Http\Controllers\Api\V1\Incident;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncidentCategory\IncidentCategoryListRequest;
use App\Http\Requests\IncidentCategory\IncidentCategoryStoreRequest;
use App\Http\Requests\IncidentCategory\IncidentCategoryUpdateRequest;
use App\Http\Resources\Incident\IncidentCategoryResource;
use App\Models\IncidentCategory;
use App\Services\IncidentCategoryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class IncidentCategoryController extends Controller
{
    public function __construct(
        private IncidentCategoryService $incidentCategoryService
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @param IncidentCategoryListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection<IncidentCategoryResource>
     */
    public function index(IncidentCategoryListRequest $request): AnonymousResourceCollection
    {
        $categories = $this->incidentCategoryService->list($request);

        return IncidentCategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param IncidentCategoryStoreRequest $request
     * @return JsonResource
     */
    public function store(IncidentCategoryStoreRequest $request): JsonResource
    {
        //
        $response = $this->incidentCategoryService->save($request);

        return IncidentCategoryResource::make($response);
    }

    /**
     * Display the specified resource.
     * 
     * @param IncidentCategory $incidentCategory
     * @return JsonResource
     */
    public function show(IncidentCategory $incidentCategory): JsonResource
    {
        $response = $this->incidentCategoryService->get($incidentCategory);

        return IncidentCategoryResource::make($response);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param IncidentCategoryUpdateRequest $request
     * @param IncidentCategory $incidentCategory
     * @return JsonResource
     */
    public function update(IncidentCategoryUpdateRequest $request, IncidentCategory $incidentCategory): JsonResource
    {
        $response = $this->incidentCategoryService->update($request, $incidentCategory);

        return IncidentCategoryResource::make($response);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param IncidentCategory $incidentCategory
     * @return Response
     */
    public function destroy(IncidentCategory $incidentCategory): Response
    {
        $this->incidentCategoryService->delete($incidentCategory);

        return response()->noContent();
    }
}
