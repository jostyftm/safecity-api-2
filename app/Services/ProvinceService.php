<?php

namespace App\Services;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProvinceService
{

    /**
     * @var string $keyCache
     */
    private string $keyCache = 'province';

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * List Province
     * 
     * @param Request $request
     * @return Collection
     */
    public function list(Request $request): Collection | AbstractPaginator
    {
        $provinces = Province::all();

        return $provinces;
    }

    /**
     * Get Province
     * 
     * @param Province $province
     * @return Province
     */
    public function get(Province $province): ?Province
    {
        $provinceResponse = Cache::remember("{$this->keyCache}_{$province->id}", 86400, function () use ($province) {
            return $province;
        });

        return $provinceResponse;
    }

    /**
     * Save Province
     * 
     * @param Request $request
     * @return Province
     */
    public function save(Request $request): Province
    {
        $province = Province::create($request->validated());

        return $province;
    }

    /**
     * Update Province
     * 
     * @param Request $request
     * @return Province
     */
    public function update(Request $request, Province $province): Province
    {
        $province->update($request->validated());

        return $province;
    }

    /**
     * Delete Province
     * 
     * @param Province $province
     * @return void
     */
    public function delete(Province $province): void
    {
        $province->delete();
    }
}
