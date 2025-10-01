<?php

namespace App\Services;

use App\Models\Incident;
use Clickbar\Magellan\Data\Geometries\Point;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class IncidentService
{

    /**
     * @var string $keyCache
     */
    private string $keyCache = 'incident';

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * List Incident
     * 
     * @param Request $request
     * @return Collection
     */
    public function list(Request $request): Collection | AbstractPaginator
    {
        $incidents = Incident::with(['category', 'user', 'city'])->get();

        return $incidents;
    }

    /**
     * Get Incident
     * 
     * @param Incident $incident
     * @return Incident
     */
    public function get(Incident $incident): ?Incident
    {
        $incidentResponse = Cache::remember("{$this->keyCache}_{$incident->id}", 86400, function () use ($incident) {
            $incident->load(['category', 'user', 'city', 'media']);

            return $incident;
        });

        return $incidentResponse;
    }

    /**
     * Save Incident
     * 
     * @param Request $request
     * @param Incident $incident
     * @return Incident
     */
    public function save(Request $request): Incident
    {
        $curresUSer = Auth::user();

        [$lat, $lng] = $request->array('location', [null, null]);

        $incident = new Incident($request->validated());
        $incident->reported_by = $curresUSer->id;
        $incident->location = Point::makeGeodetic($lat, $lng);

        $incident->save();

        return $incident;
    }

    /**
     * Update Incident
     * 
     * @param Request $request
     * @param Incident $incident
     * @return Incident
     */
    public function update(Request $request, Incident $incident): Incident
    {
        if (!is_null($incident->verified_at)) {
            throw ValidationException::withMessages([
                'incident' => [__('incident.verified_cannot_be_updated')],
            ]);
        }

        $incident->update($request->validated());
        $incident->load(['category', 'user', 'city', 'media']);

        return $incident;
    }

    /**
     * Delete Incident
     * 
     * @param Incident $incident
     * @return void
     */
    public function delete(Incident $incident): void
    {
        $incident->delete();
    }

    /**
     * Verify Incident
     * 
     * @param Incident $incident
     * @return void
     */
    public function verify(Incident $incident): void
    {
        if (!is_null($incident->verified_at)) {
            throw ValidationException::withMessages([
                'incident' => [__('incident.already_verified')],
            ]);
        }

        $incident->verified_at = now();
        $incident->save();
        $incident->load(['category', 'user', 'city', 'media']);
    }

    /**
     * Auto-assign Incident
     * 
     * @param Request $request
     * @param Incident $incident
     * @return void
     */
    public function autoAssign(Request $request, Incident $incident): void
    {
        $currentUser = Auth::user();

        if (!is_null($incident->assigned_to)) {
            throw ValidationException::withMessages([
                'incident' => [__('incident.already_assigned')],
            ]);
        }

        $incident->assigned_to = $currentUser->id;
        $incident->assigned_at = now();
        $incident->update();

        // Dispatch event
    }
}
