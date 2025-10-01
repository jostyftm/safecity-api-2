<?php

namespace App\Services;

use App\Models\AvailabilyZone;
use App\Models\ControlEntity;
use Clickbar\Magellan\Data\Geometries\LineString;
use Clickbar\Magellan\Data\Geometries\Polygon;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class AvailabilyZoneService
{

    /**
     * @var string $keyCache
     */
    private string $keyCache = 'availabilyZone';

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * List AvailabilyZone
     * 
     * @param Request $request
     * @return Collection
     */
    public function list(Request $request): Collection | AbstractPaginator
    {
        $zones = AvailabilyZone::all();

        return $zones;
    }

    /**
     * Get AvailabilyZone
     * 
     * @param AvailabilyZone $availabilyZone
     * @return AvailabilyZone
     */
    public function get(AvailabilyZone $availabilyZone): ?AvailabilyZone
    {
        $availabilyZoneResponse = Cache::remember("{$this->keyCache}_{$availabilyZone->id}", 86400, function () use ($availabilyZone) {
            return $availabilyZone;
        });

        return $availabilyZoneResponse;
    }

    /**
     * Save AvailabilyZone
     * 
     * @param Request $request
     * @param AvailabilyZone $availabilyZone
     * @return void
     */
    public function save(Request $request, ControlEntity $controlEntity): AvailabilyZone
    {
        $availabilyZone = new AvailabilyZone($request->all());
        // $lines = new LineString($request->array(''))}
        // $area = new Polygon(LineString)
        // $controlEntity->availabilyZones()->save($availabilyZone);

        return $availabilyZone;
    }

    /**
     * Update AvailabilyZone
     * 
     * @param Request $request
     * @param AvailabilyZone $availabilyZone
     * @return void
     */
    public function update(Request $request, AvailabilyZone $availabilyZone): AvailabilyZone
    {
        $availabilyZone->update($request->all());

        return $availabilyZone;
    }

    /**
     * Delete AvailabilyZone
     * 
     * @param AvailabilyZone $availabilyZone
     * @return void
     */
    public function delete(AvailabilyZone $availabilyZone): void
    {
        $availabilyZone->delete();
    }
}
