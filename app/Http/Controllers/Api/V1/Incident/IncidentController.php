<?php

namespace App\Http\Controllers\Api\V1\Incident;

use App\Http\Controllers\Controller;
use App\Http\Requests\Incident\IncidentListRequest;
use App\Http\Requests\Incident\IncidentStoreRequest;
use App\Http\Requests\Incident\IncidentUpdateRequest;
use App\Http\Resources\Incident\IncidentResource;
use App\Models\Incident;
use App\Services\IncidentService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class IncidentController extends Controller
{
    public function __construct(
        private IncidentService $incidentService
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @param IncidentListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection<IncidentResource>
     */
    public function index(IncidentListRequest $request): AnonymousResourceCollection
    {
        $incidents = $this->incidentService->list($request);

        return IncidentResource::collection($incidents);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param IncidentStoreRequest $request
     * @return JsonResource
     */
    public function store(IncidentStoreRequest $request): JsonResource
    {
        $incident = $this->incidentService->save($request);

        return new IncidentResource($incident);
    }

    /**
     * Display the specified resource.
     */
    public function show(Incident $incident): JsonResource
    {
        $incident = $this->incidentService->get($incident);

        return new IncidentResource($incident);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param IncidentUpdateRequest $request
     * @param Incident $incident
     * @return JsonResource
     */
    public function update(IncidentUpdateRequest $request, Incident $incident): JsonResource
    {
        $incident = $this->incidentService->update($request, $incident);

        return new IncidentResource($incident);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Incident $incident
     * @return Response
     */
    public function destroy(Incident $incident): Response
    {
        $incident->delete();

        return response()->noContent();
    }

    /**
     * Verify the specified resource.
     * 
     * @param Incident $incident
     * @return Response
     */
    public function verify(Incident $incident): Response
    {
        $this->incidentService->verify($incident);

        return response()->noContent();
    }

    /**
     * Find matching incidents based on location and category.
     * 
     * @param Incident $incident
     * @return Response
     */
    public function autoAssign(Request $request, Incident $incident): Response
    {
        $this->incidentService->autoAssign($request, $incident);

        return response()->noContent();
    }
}
