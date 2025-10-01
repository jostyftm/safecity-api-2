<?php

namespace App\Services;

use App\Models\IncidentCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class IncidentCategoryService
{

    /**
     * @var string $keyCache
     */
    private string $keyCache = 'incidentCategory';

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * List IncidentCategory
     * 
     * @param Request $request
     * @return Collection
     */
    public function list(Request $request): Collection | AbstractPaginator
    {
        $categories = IncidentCategory::all();

        return $categories;
    }

    /**
     * Get IncidentCategory
     * 
     * @param IncidentCategory $incidentCategory
     * @return IncidentCategory
     */
    public function get(IncidentCategory $incidentCategory): ?IncidentCategory
    {
        $incidentCategoryResponse = Cache::remember("{$this->keyCache}_{$incidentCategory->id}", 86400, function () use ($incidentCategory) {
            return $incidentCategory;
        });

        return $incidentCategoryResponse;
    }

    /**
     * Save IncidentCategory
     * 
     * @param Request $request
     * @param IncidentCategory $incidentCategory
     * @return IncidentCategory
     */
    public function save(Request $request): IncidentCategory
    {
        $incidentCategory = IncidentCategory::create($request->all());

        return $incidentCategory;
    }

    /**
     * Update IncidentCategory
     * 
     * @param Request $request
     * @param IncidentCategory $incidentCategory
     * @return IncidentCategory
     */
    public function update(Request $request, IncidentCategory $incidentCategory): IncidentCategory
    {
        $incidentCategory->update($request->all());

        return $incidentCategory;
    }

    /**
     * Delete IncidentCategory
     * 
     * @param IncidentCategory $incidentCategory
     * @return void
     */
    public function delete(IncidentCategory $incidentCategory): void
    {
        $incidentCategory->delete();
    }
}
